Lost & Found Management System Documentation
GitHub Repository:
https://github.com/fa23bse008abdul-hue/lostfound
Student Name
June 12, 2026
Contents
1 Introduction 3
1.1 Introduction . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 3
1.2 Objectives . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 3
1.3 ToolsandTechnologies . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 3
1.4 ObjectivesoftheProposedSystem . . . . . . . . . . . . . . . . . . . . . . . . . . 4
2 ProjectStructure 5
2.1 ProjectStructure . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 5
3 SystemArchitecture 6
3.1 SystemArchitecture . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 6
3.1.1 Model . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 6
3.1.2 View . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 6
3.1.3 Controller . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 6
4 DatabaseDesign 7
4.1 UsersTable . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 7
4.2 LostItemsTable . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 7
4.3 FoundItemsTable . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 7
5 Routing 9
5.1 Routing . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 9
6 LostItemModule 10
6.1 Features . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 10
7 FoundItemModule 11
7.1 Features . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 11
8 AuthenticationSystem 12
8.1 AuthenticationFeatures . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 12
9 Dashboard 13
9.1 DashboardOverview . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 13
10ValidationRules 14
11SecurityFeatures 15
1
COMSATSUniversityIslamabad Lost&FoundManagementSystem
12UserInterfaceScreens 16
12.1HomePage . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 16
12.2LoginPage . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 17
12.3DashboardPage. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 18
12.4LostItemsPage . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 19
12.5FoundItemsPage. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 20
12.6ProfilePage . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 21
13ApplicationWorkflow 22
14AdvantagesoftheSystem 23
15FutureImprovements 24
16Conclusion 25
2
Chapter 1
Introduction
1.1 Introduction
The Lost & Found Management System is a web-based application developed using the Laravel
Framework. The purpose of the system is to help users report lost items and found items through
a centralized platform. Users can submit item details, upload images, search available records,
and manage their reports securely.
The application follows the MVC (Model-View-Controller) architecture and provides authen
tication, authorization, item tracking, image upload, search functionality, and responsive user
interfaces.
1.2 Objectives
• Provide a centralized platform for lost and found items.
• Allow users to report lost items.
• Allow users to report found items.
• Support item searching and filtering.
• Ensure secure user authentication.
• Improve item recovery efficiency.
• Demonstrate Laravel MVC architecture.
1.3 Tools and Technologies
Technology
Purpose
Laravel
Backend Framework
PHP
Server-side Programming
Blade Templates
Frontend Rendering
SQLite/MySQL
Database Storage
Bootstrap/Tailwind CSS
User Interface Design
3
COMSATS University Islamabad
Lost & Found Management System
Laravel Authentication
User Authentication
File Storage
Image Upload Management
1.4 Objectives of the Proposed System
• Develop a secure Lost & Found Management application.
• Allow users to report and manage items.
• Provide searching and filtering functionality.
• Support image uploads.
• Improve communication between item owners and finders.
4
Chapter 2
Project Structure
2.1 Project Structure
app/
routes/
database/
resources/
Http/
Controllers/
DashboardController .php
LostItemController .php
FoundItemController .php
ProfileController .php
Models/
User .php
LostItem .php
FoundItem.php
web.php
migrations/
database . sqlite
views/
l ost−items/
found−items/
dashboard/
profile /
5
Chapter 3
System Architecture
3.1 System Architecture
The application follows MVC (Model-View-Controller) architecture.
3.1.1 Model
Models represent database entities such as:
• User
• Lost Item
• Found Item
3.1.2 View
Blade templates inside the resources/views directory render user interfaces.
3.1.3 Controller
Controllers process user requests, perform business logic, and return responses.
6
Chapter 4
Database Design
4.1 Users Table
Field
Type
Description
id
Integer
name
Primary Key
String
email
User Name
String
password
User Email
String
created at
Encrypted Password
Timestamp
updated at
Creation Time
Timestamp
Update Time
4.2 Lost Items Table
Field
Type
id
Description
Integer
user id
Primary Key
Integer
item name
Owner ID
String
category
Item Name
String
description
Item Category
Text
location
Description
String
contact details
Lost Location
String
image path
Contact Information
String
status
Uploaded Image
String
created at
Pending/Claimed
Timestamp
updated at
Creation Time
Timestamp
Update Time
4.3 Found Items Table
Field
Type
id
Description
Integer
user id
Primary Key
Integer
Finder ID
7
COMSATS University Islamabad
Lost & Found Management System
item name
String
Item Name
category
String
description
Item Category
Text
location
Description
String
contact details
Found Location
String
image path
Contact Information
String
status
Uploaded Image
String
created at
Available/Returned
Timestamp
updated at
Creation Time
Timestamp
Update Time
8
Chapter 5
Routing
5.1 Routing
Route :: resource (
’ lost−items ’ ,
LostItemController :: class
) ;
Route :: resource (
’ found−items ’ ,
FoundItemController :: class
) ;
Route :: get(
’ /dashboard ’ ,
DashboardController :: class
) ;
9
Chapter 6
Lost Item Module
6.1 Features
• Add Lost Item
• Edit Lost Item
• Delete Lost Item
• Search Lost Items
• Upload Images
• View Item Details
10
Chapter 7
Found Item Module
7.1 Features
• Add Found Item
• Edit Found Item
• Delete Found Item
• Mark Item Returned
• Upload Images
• Search Found Items
11
Chapter 8
Authentication System
8.1 Authentication Features
• User Registration
• User Login
• Password Reset
• Email Verification
• Profile Management
• Logout
12
Chapter 9
Dashboard
9.1 Dashboard Overview
The dashboard displays:
• Total Lost Items
• Total Found Items
• Claimed Items
• Returned Items
• User Statistics
13
Chapter 10
Validation Rules
$request−>validate ([
’ item
name ’ => ’required |max:255 ’ ,
’ description ’ => ’required ’ ,
’ location ’ => ’required ’ ,
’ image ’ => ’nullable |image ’
] ) ;
14
Chapter 11
Security Features
• Route Protection
• Authentication Middleware
• Authorization Checks
• Input Validation
• CSRF Protection
• Password Hashing
• Ownership Verification
15
Chapter 12
User Interface Screens
12.1 Home Page
Figure 12.1: Home Page
16
COMSATS University Islamabad
Lost & Found Management System
Figure 12.2: Home Page (Alternative View)
12.2 Login Page
Figure 12.3: Login Page
17
COMSATS University Islamabad
Lost & Found Management System
12.3 Dashboard Page
Figure 12.4: Dashboard Page
18
COMSATS University Islamabad
Lost & Found Management System
12.4 Lost Items Page
Figure 12.5: Lost Item Listing Page
Figure 12.6: Edit Lost Item Page
19
COMSATS University Islamabad
Lost & Found Management System
12.5 Found Items Page
Figure 12.7: Found Item Listing Page
20
COMSATS University Islamabad
Lost & Found Management System
12.6 Profile Page
Figure 12.8: Profile Page
Figure 12.9: Profile Settings Page
21
Chapter 13
Application Workflow
1. User registers and logs in.
2. User accesses dashboard.
3. User reports lost item.
4. User reports found item.
5. System stores information in database.
6. Users search available records.
7. Item owner contacts finder.
8. Item status is updated.
9. Dashboard statistics are refreshed.
22
Chapter 14
Advantages of the System
• Easy item tracking
• Secure authentication
• Image upload support
• Fast searching
• Responsive design
• User-friendly interface
• Scalable architecture
23
Chapter 15
Future Improvements
• Email Notifications
• Mobile Application
• Google Maps Integration
• QRCode Tracking
• AI-based Item Matching
• Admin Management Panel
• Real-Time Notifications
• SMS Alerts
24
Chapter 16
Conclusion
The Lost & Found Management System demonstrates the implementation of Laravel MVC archi
tecture, authentication, database management, and image handling. The application provides a
secure and efficient platform for managing lost and found items while maintaining scalability and
usability for future enhancements.
25
