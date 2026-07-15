LEGACY RESTRUCTURING CAMPAIGN
Converted to standard HTML, CSS and vanilla JavaScript.

FILES
- index.html: Page structure and content
- styles.css: Responsive page styling and local font declarations
- script.js: Dynamic cards, rotating headline, countdown, mobile menu, FAQ and form behaviour
- assets/entrust-logo.png: Entrust CFO Services logo
- assets/chess-strategy.jpg: Strategy section artwork
- assets/lucide.js: Local icon library
- assets/*.woff2: Local font files retained from the source bundle

HOW TO RUN
Open index.html directly in a browser, or serve the folder with any static server.
Example:
  python -m http.server 8000
Then open:
  http://localhost:8000

FORM NOTE
The form currently validates in the browser and shows a success state. It does not send data to a server. Connect the submit handler in script.js to your CRM, email service, Laravel endpoint or other backend.

COUNTDOWN
The campaign countdown target is set near the top of script.js:
  2026-09-15T23:59:59+05:30

UPDATE:
- Added a dedicated eligibility section, including the ₹5–50 Crore annual turnover criterion.
