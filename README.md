# Deepseek UI - Laravel Chat Interface

A modern chat application built with Laravel, integrating Deepseek AI for intelligent conversations. Features include authentication, dark mode, and real-time messaging.

![screenshot-127_0_0_1_8000-2025_02_08-11_03_52](https://github.com/user-attachments/assets/cb4957bc-2e3a-4602-adf5-7ef28cdecc3d)

## Features

- 🤖 AI-powered chat using Deepseek API
- 🌓 Dark/Light mode toggle
- 🔐 User authentication system
- 💬 Real-time messaging
- 📱 Responsive design
- 🗑️ Chat session management

## Prerequisites

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL or SQLite
- Deepseek API key

## Installation

1. Clone the repository
```bash
git clone https://github.com/YOUR_USERNAME/YOUR_REPOSITORY_NAME.git
cd YOUR_REPOSITORY_NAME
```

2. Install PHP dependencies
```bash
composer install
```

3. Install NPM dependencies
```bash
npm install
```

4. Create environment file
```bash
cp .env.example .env
```

5. Configure your .env file
```env
APP_NAME="Deepseek Chat"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

DEEPSEEK_API_KEY=your_deepseek_api_key
```

6. Generate application key
```bash
php artisan key:generate
```

7. Run database migrations
```bash
php artisan migrate
```

8. Build assets
```bash
npm run dev
```

9. Start the development server
```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Usage

1. Register a new account or login
2. Click "New Chat" to start a conversation
3. Type your message and press Enter or click Send
4. Use the sidebar to manage chat sessions
5. Toggle dark mode using the profile menu

## Features in Detail

### Chat Management
- Create new chat sessions
- Rename existing chats
- Delete chat sessions
- View chat history

### User Profile
- Update profile information
- Change password
- Delete account
- Toggle dark/light mode

### UI/UX
- Responsive design for mobile and desktop
- Real-time message updates
- Loading states and animations
- Error handling and notifications

### Screenshots

Light Mode
![light](https://github.com/user-attachments/assets/c78db8ef-ffd1-485e-bb65-0424f7c95f09)

Dark Mode
![dark](https://github.com/user-attachments/assets/4906e619-52e9-4c74-bec1-dd84f17250be)


## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support

For support, please open an issue in the GitHub repository.

## Acknowledgments

- [Laravel](https://laravel.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Alpine.js](https://alpinejs.dev)
- [Deepseek AI](https://deepseek.com)
