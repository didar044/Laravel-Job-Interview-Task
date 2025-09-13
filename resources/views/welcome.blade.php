
<head>
    <title>Welcome Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h1 {
            color: #2563eb;
            margin-bottom: 20px;
        }

        span {
            font-weight: bold;
            color: #dc2626;
        }

        a button {
            background: #2563eb;
            color: white;
            border: none;
            padding: 12px 24px;
            margin-top: 20px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        a button:hover {
            background: #1d4ed8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome To Our Page</h1>
        <p>
            If you want to go <span>Laravel-Course-Management-System</span>
        </p>
        <a href='{{ url("courses") }}'>
            <button>Click Here</button>
        </a>
    </div>
</body>
</html>
