# THE V.O.I.D. - Technical Documentation

## 1. Project Overview
**THE V.O.I.D.** (formerly "The Archive") is an avant-garde, Brutalist-Editorial styled digital note-taking application. It transcends traditional CRUD applications by heavily emphasizing high-end aesthetics, physics-based interactions, and cinematic animations, aiming for an "Awwwards-level" user experience.

## 2. Architecture & Tech Stack
*   **Backend:** PHP (Native/Vanilla) >= 8.1
*   **Frontend:** HTML5, Tailwind CSS (via PostCSS/CLI), Vanilla JavaScript
*   **Database:** MySQL
*   **Typography:** Syne (Display), Cormorant Garamond (Serif), JetBrains Mono (Monospace)
*   **Assets:** Unsplash API (for dynamic imagery based on note IDs)

## 3. Directory & File Structure
```text
/ (Root Directory)
├── .git/                  # Version control repository
├── .gitignore             # Ignored files (node_modules, etc.)
├── README.md              # Public-facing project argument and quick start
├── documentation.md       # Comprehensive technical documentation
├── package.json           # Node.js dependencies (Tailwind CSS)
├── package-lock.json      # Dependency lockfile
├── tailwind.config.js     # Tailwind CSS configuration and custom theme/keyframes
├── input.css              # Custom CSS rules, SVG filters, and cursor logic
├── output.css             # Compiled Tailwind CSS (generated)
├── notes_app.sql          # Database schema export
│
├── config/
│   └── koneksi.php        # Database connection establishment
│
├── components/
│   ├── header.php         # Global HTML head, meta tags, and cursor/SVG filter definitions
│   └── footer.php         # Global closing tags and universal JavaScript (marquee, cursor)
│
├── index.php              # Landing page (Login) with particle system canvas
├── register.php           # User registration page
├── dashboard.php          # Main application interface (Note listing, 3D tilt cards)
├── edit.php               # Interface for modifying existing notes
├── db.php                 # Core logic for handling CRUD operations (Create, Read, Delete)
└── logout.php             # Session termination script
```

## 4. Database Schema (`notes_app`)
The system uses a simple relational database structure with two main tables.

### `users`
Handles authentication and user identity.
*   `id` (INT, Primary Key, Auto Increment)
*   `username` (VARCHAR 255, Unique)
*   `password` (VARCHAR 255) - Stores `password_hash()` values.
*   `created_at` (TIMESTAMP)

### `notes`
Stores the fragments of thoughts (notes) linked to specific users.
*   `id` (INT, Primary Key, Auto Increment)
*   `user_id` (INT, Foreign Key referencing `users.id`)
*   `title` (VARCHAR 255)
*   `content` (TEXT)
*   `created_at` (TIMESTAMP)

## 5. UI/UX & Core Features ("Mega Engineering Wonder")
The application implements 12 strict aesthetic rules:

1.  **Liquid/Blob Animation:** Implemented via `<feTurbulence>` and `<feGaussianBlur>` SVG filters in `components/header.php`, applied to CSS classes in `input.css` to create organic, shifting backgrounds.
2.  **Particle System Canvas:** A custom JavaScript canvas implementation in `index.php` where nodes connect via lines when proximity thresholds are met.
3.  **Glitch Text & Typewriter:** CSS `clip-path` animations and JavaScript typewriter effects used for dramatic reveals.
4.  **Infinite Marquee:** CSS keyframe animations creating a continuous scrolling text effect that reverses direction on hover.
5.  **Magnetic Elements:** Buttons scale using custom `cubic-bezier` curves and `transform-origin` adjustments for physical feel.
6.  **3D Perspective Tilt:** JavaScript in `dashboard.php` tracks `mousemove` events over note cards, calculating rotational values applied via CSS `transform: perspective(1000px) rotateX(...) rotateY(...)`.
7.  **Dynamic Imagery:** Notes fetch contextual images from `source.unsplash.com/random` utilizing CSS blend modes (`mix-blend-luminosity`, `grayscale`) to match the dark theme.
8.  **Staggered Reveals:** Elements use CSS `animation-delay` mapped to nth-child selectors to orchestrate grand entrance animations.
9.  **Physics Cursor Trail:** The default cursor is hidden. A custom div (`.cursor-dot` and `.cursor-trail`) follows mouse coordinates using JavaScript `requestAnimationFrame` for smooth interpolation.
10. **Extreme Typography:** High-contrast type scales defined in `tailwind.config.js` and applied generously across the UI.
11. **Grid-Breaking Layout:** CSS Grid and Flexbox used asymmetrically in `dashboard.php` to create a masonry-like, chaotic yet structured feel.
12. **Vanta Black Theme:** A custom color palette (`vanta: #050505`, `neon: #FF2A00`) enforces a strict, high-contrast dark mode.

## 6. Setup & Installation
1.  **Environment:** Ensure PHP 8.1+ and MySQL are running.
2.  **Database:** Import `notes_app.sql` into a new MySQL database named `notes_app`.
3.  **Dependencies:** Run `npm install` to install Tailwind CSS.
4.  **Compilation:** Run `npx tailwindcss -i input.css -o output.css --watch` to compile the styles.
5.  **Serve:** Serve the directory using `php -S localhost:8000` or via Laragon/XAMPP.

## 7. Security Considerations
*   **Authentication:** Passwords are encrypted using PHP's native `password_hash(PASSWORD_BCRYPT)` and verified using `password_verify()`.
*   **SQL Injection Prevention:** Input sanitization relies heavily on `mysqli_real_escape_string()`. *(Note: For production, migrating to PDO Prepared Statements is highly recommended to fortify against advanced injection attacks).*
*   **Session Management:** Standard PHP `$_SESSION` handling is used for access control, preventing direct URL access to protected routes like `dashboard.php`.

## 8. Development Workflow
*   Changes to styling should only be made via Tailwind utility classes in the PHP files or by modifying `input.css`.
*   Always ensure the Tailwind compiler (`npx tailwindcss --watch`) is running to regenerate `output.css` when making design changes.
*   The system utilizes `include 'components/header.php'` and `footer.php` to maintain DRY (Don't Repeat Yourself) principles across pages.

---
*End of Documentation.*
