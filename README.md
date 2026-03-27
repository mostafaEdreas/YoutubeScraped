# YouTube Scraper Application

This application is a web-based tool designed to scrape YouTube data based on user-provided categories and display the results in a categorized, filterable interface. The frontend is built using JavaScript, jQuery, Bootstrap, and CSS.

---

## Setup Instructions

### Prerequisites
- A web server (e.g., Apache, Nginx, or XAMPP).
- PHP 8.4 and Composer installed.
- Basic knowledge of JavaScript, jQuery, and Bootstrap.

### Installation Steps
1. **Clone the repository**:
   ```bash
   git clone https://github.com/mostafaEdreas/YoutubeScraped.git
   cd YoutubeScraped
   ```

2. **Install PHP dependencies**:
   ```bash
   composer install
   ```

3. **Set up the environment file**:
   ```bash
   cp .env.example .env
   ```
   Update the `.env` file with your database credentials and API keys (see the "API Keys Configuration" section below).

4. **Generate the application key**:
   ```bash
   php artisan key:generate
   ```

---

## API Keys Configuration

To configure the API keys, update the `.env` file with the following variables:

# How to Obtain the YouTube API Key
1. Go to the Google Cloud Console.
2. Create a new project or select an existing one.
3. Navigate to APIs & Services > Library.
4. Search for "YouTube Data API v3" and enable it for your project.
5. Go to APIs & Services > Credentials.
6. Click Create Credentials and select API Key.
7. Copy the generated API key and add it to your .env file as `YOUTUBE_API_KEY`.

# How to Obtain the Groq API Key
1. Visit the Groq Console.
2. Sign in or create an account.
3. Navigate to the API Keys section.
4. Click Create new key and copy the generated key.
5. Add the key to your .env file as`OPENAI_API_KEY`.
---

## How to Run the Project

1. Start the development server:
   ```bash
   php artisan serve
   ```

2. Open your browser and navigate to:
   ```
   http://localhost:8000
   ```

3. Use the application to scrape YouTube data and view results in the user-friendly interface.

---

## Frontend Technologies

- **JavaScript**: Handles dynamic interactions and API calls.
- **jQuery**: Simplifies DOM manipulation and AJAX requests.
- **Bootstrap**: Provides responsive design and pre-styled components.
- **CSS**: Customizes the look and feel of the application.

---

## License
This project is licensed under the MIT License."# YoutubeScraped" 
