# Information
## organization
  	Faculty of Information Technology - University of Science Ho Chi Minh City - Vietnam National University
## lecturer
  	Nguyễn Đức Huy
## students
  	1560489 Cao Lê Tâm
  	1560528 Trần Thị Thắm
  	1560538 Võ Như Thiết
## subject
  	Web Programming 2
## project
  	Final project

# Organization
	University of Science Ho Chi Minh City - Vietnam National University
	Faculty of Information Technology

# Host config
## .htaccess config
    RewriteEngine On
    RewriteCond %{HTTPS} off
    RewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI} [L,R]

