# Graph Plotting Website

An interactive web application for visualising mathematical functions and data. Users type a
polynomial or algebraic expression and the app parses it, evaluates it across a range, and renders
the curve in the browser — alongside a set of chart demos including a live-updating stream and a 3D
surface plot.

Built with vanilla HTML, CSS and JavaScript on the front end, Plotly.js for rendering, math.js for
expression parsing, and a PHP + MySQL backend for the feedback form.

![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript&logoColor=black)
![Bootstrap](https://img.shields.io/badge/Bootstrap_5-7952B3?logo=bootstrap&logoColor=white)
![Plotly](https://img.shields.io/badge/Plotly.js-3F4F75?logo=plotly&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white)

---

## Features

**Equation plotter** — enter an arbitrary expression (for example `x^2 - 3x + 2` or `sin(x)/x`) and
the app compiles it with math.js, evaluates it over a generated range, and plots the resulting curve
as an interactive Plotly scatter trace. No page reload; parsing and rendering happen entirely
client-side.

**Live streaming chart** — a continuously updating line chart driven by `Plotly.extendTraces`, which
appends points to an existing trace and pans the axis rather than redrawing the whole figure. This is
the efficient pattern for real-time data and avoids the flicker of a full re-render.

**3D surface plot** — a `surface` trace rendered in three dimensions, rotatable and zoomable directly
in the browser.

**Chart gallery** — additional chart types demonstrating the range of visualisations available.

**Feedback form** — a Bootstrap form that POSTs to a PHP endpoint, which connects to MySQL and
persists submissions.

**Responsive layout** — Bootstrap 5 grid and components throughout, with a shared navigation bar
linking the pages.

---

## Tech stack

| Layer | Technology |
|---|---|
| Structure | HTML5 |
| Styling | CSS3, Bootstrap 5 |
| Interactivity | Vanilla JavaScript (ES6) |
| Charting | Plotly.js |
| Expression parsing | math.js (`math.compile`, `math.range`) |
| Backend | PHP |
| Database | MySQL (via `mysqli`) |
| Server | Apache (XAMPP) |

No build step and no framework — the pages run directly in the browser, with libraries loaded from
CDN.

---

## Getting started

### Static pages only

The plotting pages need no backend. Clone and open the entry page:

```bash
git clone https://github.com/novaxertz/graph-plotting-website.git
cd graph-plotting-website
```

Then open `Mini Project/webpage1.html` in any modern browser. An internet connection is required, as
Bootstrap, Plotly.js and math.js load from CDN.

### With the feedback backend

The feedback form requires PHP and MySQL. Using [XAMPP](https://www.apachefriends.org/):

1. Copy the project into your web root, e.g. `C:\xampp\htdocs\feedback\`
2. Start **Apache** and **MySQL** from the XAMPP control panel
3. Create the database:

   ```sql
   CREATE DATABASE feedback;
   ```

   The `feed` table is created automatically on first submission.
4. Visit `http://localhost/feedback/Mini Project/webpage1.html`

If your MySQL credentials differ from the default (`root` with no password), update the connection
line in `feedback.php`.

---

## Project structure

```
Mini Project/
  webpage1.html     Home - project introduction and navigation
  webpage2.html     Polynomial plotter - equation input, math.js parsing, Plotly output
  webpage3.html     Live streaming line chart (Plotly.extendTraces)
  webpage4.html     3D surface plot
  webpage5.html     Chart gallery
  webpage6.html     Feedback form
  *.png, *.jpg      Image assets and icons
feedback.php        PHP endpoint - receives the form POST and writes to MySQL
```

---

## How the plotter works

The equation plotter is the core of the project. The pipeline is:

1. **Read** the expression string from the input field
2. **Compile** it once with `math.compile(expr)` — parsing ahead of evaluation rather than
   re-parsing per point
3. **Generate** an x range with `math.range(...)`
4. **Evaluate** the compiled expression at each x to produce the y values
5. **Render** the (x, y) pairs as a Plotly `scatter` trace

Compiling once and evaluating many times keeps the plot responsive across a dense range, and it means
arbitrary user expressions are handled without resorting to `eval`.

---

## Status and known limitations

Built as an academic mini-project and published as-is. Documented honestly rather than left for a
reader to discover:

- **`feedback.php` is vulnerable to SQL injection.** POST values are interpolated directly into the
  query string rather than bound as parameters. It would need `mysqli` prepared statements before any
  real deployment.
- **Database credentials are hardcoded** in `feedback.php` and assume the XAMPP default of `root`
  with an empty password. These belong in configuration kept out of version control.
- **The table is re-created on every submission** with `CREATE TABLE`, rather than being provisioned
  once through a migration.
- **No input validation on the plotter.** A malformed expression fails silently instead of surfacing
  a message to the user.
- **Directory name contains a space** (`Mini Project/`), which is awkward in URLs and on the command
  line.

---

## Possible improvements

- Replace the raw queries with prepared statements and move credentials into environment configuration
- Add error handling and user-facing validation messages to the equation input
- Support plotting multiple expressions on the same axes for comparison
- Allow the x range and resolution to be configured from the UI
- Consolidate the six pages into a single-page app with client-side routing

---

## Author

**Ibrahim Ansar**
[GitHub](https://github.com/novaxertz) · [LinkedIn](https://linkedin.com/in/ibrahim-ansar-a9571a16b)
