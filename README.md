## Information
# organization
  Faculty of Information Technology - University of Science Ho Chi Minh City - Vietnam National University
# lecturers
  Nguyễn Đức Huy
# student
  1560489 Cao Lê Tâm
  1560528 Trần Thị Thắm
  1560538 Võ Như Thiết
# subject
  Web Programming 2
# project
  final project

## Organization
	University of Science Ho Chi Minh City - Vietnam National University
	Faculty of Information Technology

## SSL certificate

	

## host config
# .htaccess config
    RewriteEngine On
    RewriteCond %{HTTPS} off
    RewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI} [L,R]

