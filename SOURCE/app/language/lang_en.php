<?php
// ************************************************************************************//
// * xUCP Police Center Free
// ************************************************************************************//
// * Author: DerStr1k3r
// ************************************************************************************//
// * Version: 2.4
// *
// * Copyright (c) 2023 - 2024 DerStr1k3r. All rights reserved.
// ************************************************************************************//
// * License Typ: GNU GPLv3
// ************************************************************************************//
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {        
	header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
	setCookie("PHPSESSID", "", 0x7fffffff,  "/");
  	session_destroy();
	die( header( 'location: /vendor/webcp/404/index.php' ) );
}
const DASHBOARD = "Dashboard";
const HOME_NOLOGGED = "Home";
const USERACCOUNT = "Account Tools";
const USERPROFILECHANGE = "User Settings";
const WELCOMETO = "Welcome to";
const XUCP_POL_LOGOUT = "Logout";
const NEWS = "News: ";
const SECURE_SYSTEM = "Secure System";

// ************************************************************************************//
// * English Language Section - Wanted
// ************************************************************************************//
const WANTED_HEADER = "Warrants";
const WANTED_FILE_NUMBER = "Warrant number";
const WANTED_JOB = "Job";
const WANTED_MSG = "Message";
const WANTED_PERSON = "Name";
const WANTED_PHONENUMBER = "Phonenumber";
const WANTED_IS_WANTED = "is wanted";
const WANTED_ENTRY_NOT_WORK = "Your entry was unsuccessful!";
const WANTED_ENTRY_WORKING = "Your entry was successful!";
const WANTED_DATE = "Date";
const WANTED_FROM_CREATED = "created by";
const WANTED_DISCORD_NOTES = "A new wanted has been created!";
const WANTED_ADD = "Add wanted";
const WANTED_EDIT = "edit";
const WANTED_VIEW = "View";
const WANTED_PRINT = "Print warrant";

// ************************************************************************************//
// * English Language Section - Dashboard
// ************************************************************************************//
const DASHBOARDWANTED = "Warrants";
const DASHBOARDCRIMINALRECORDS = "Cases";
const DASHBOARD_LAST_ENTRY = "The last entry was?";
const DASHBOARD_PDUTY_HEADER = "Patrol Service";

// ************************************************************************************//
// * English Language Section - Faction Logbook
// ************************************************************************************//
const FACTION_LOGBOOK_HEADER = "Faction Logbook";
const FACTION_LOGBOOK_DESC = "Description";

// ************************************************************************************//
// * English Language Section - Resident Database
// ************************************************************************************//
const RESIDENT_DATABASE_HEADER = "Resident Database";
const RESIDENT_DATABASE_NAME = "Name";
const RESIDENT_DATABASE_JOB = "Job";
const RESIDENT_DATABASE_BIRTHDATE = "Date of birth";
const RESIDENT_DATABASE_BIRTHPLACE = "Place of birth";

// ************************************************************************************//
// * English Language Section - Traffic Database
// ************************************************************************************//
const ROAD_TRAFFIC_OFFICE_HEADER = "Road Traffic Office";
const ROAD_TRAFFIC_OFFICE_VEH_NAME = "Vehicle name";
const ROAD_TRAFFIC_OFFICE_VEH_PLATE = "Plate";
const ROAD_TRAFFIC_OFFICE_PRINT = "Print";

// ************************************************************************************//
// * English Language Section - Discord Web-Hook Message System
// ************************************************************************************//
const DCWEBHOOK_INFO_LOGIN_1 = "It has just";
const DCWEBHOOK_INFO_LOGIN_2 = "logged into the xUCP!";
const DCWEBHOOK_INFO_REGISTER_1 = "It has just turned";
const DCWEBHOOK_INFO_REGISTER_2 = "registered in xUCP!";

// ************************************************************************************//
// * English Language Section - Teamlist System
// ************************************************************************************//
const TLIST_LEFT_NAVI_HEADER = "Faction Members";
const TLIST_POLICE_RANK_0 = "Citizens";
const TLIST_POLICE_RANK_1 = "Rekrut";
const TLIST_POLICE_RANK_2 = "Officer I";
const TLIST_POLICE_RANK_3 = "Officer II";
const TLIST_POLICE_RANK_4 = "Senior Officer";
const TLIST_POLICE_RANK_5 = "Sergeant I";
const TLIST_POLICE_RANK_6 = "Sergeant II";
const TLIST_POLICE_RANK_7 = "Lieutenant";
const TLIST_POLICE_RANK_8 = "Captain";
const TLIST_POLICE_RANK_9 = "Commander";
const TLIST_POLICE_RANK_10 = "Deputy Chief";
const TLIST_POLICE_RANK_11 = "Assistant Chief";
const TLIST_POLICE_RANK_12 = "Chief of Police";

// ************************************************************************************//
// * English Language Section - Wanted
// ************************************************************************************//
const CASES_HEADER = "Cases";
const CASES_FILE_NUMBER = "Cases number";
const CASES_JOB = "Job";
const CASES_MSG = "Message";
const CASES_PERSON_NAME = "Name";
const CASES_PERSON_PHONENUMBER = "phone number";
const CASES_PERSON_GENDER = "gender";
const CASES_PERSON_BIRTHDAY = "birthday";
const CASES_PERSON_SIZE = "size";
const CASES_PERSON_EYE_COLOR = "eye color";
const CASES_PERSON_HAIR_COLOR = "Hair color";
const CASES_PERSON_MOTORCYCLE_LICENSE = "motorcycle license";
const CASES_PERSON_CAR_LICENSE = "driver's license";
const CASES_PERSON_TRUCK_LICENSE = "truck license";
const CASES_PERSON_GUN_LICENSE = "gun license";
const CASES_PERSON_OTHERS = "Miscellaneous";
const CASES_VEH_PLATE = "vehicle license plate";
const CASES_VEH_NAME = "vehicle name";
const CASES_VEH_ALL_VEHICLES = "All vehicles";
const CASES_TESTIFY = "witness";
const CASES_ENTRY_NOT_WORK = "Your entry was unsuccessful!";
const CASES_ENTRY_WORKING = "Your entry was successful!";
const CASES_IS_FINISHED = "file closed?";
const CASES_DATE = "Date";
const CASES_FROM_CREATED = "created by";
const CASES_DISCORD_NOTES = "A new file has been created.";
const CASES_ADD = "Create a new Case";
const CASES_EDIT = "Case edit";
const CASES_VIEW = "Open the Case";
const CASES_PRINT = "Print Case";

// ************************************************************************************//
// * English Language Section - Database Sync
// ************************************************************************************//
const DBSYNC_HEADER = "Database Sync";
const DBSYNC_HOSTNAME = "Hostname";
const DBSYNC_PORT = "Port";
const DBSYNC_USERNAME = "Username";
const DBSYNC_PASSWORD = "Password";
const DBSYNC_DBNAME = "Database Name";
const DBSYNC_ENTRY_NOT_WORK = "Your wanted entry was unsuccessful!";
const DBSYNC_ENTRY_WORKING = "Your wanted entry was successful!";
const DBSYNC_START_SYNC = "Start Sync";

// ************************************************************************************//
// * English Language Section - Paragraph Manager & Paragraph Viewer
// ************************************************************************************//
const PARAGRAPH_MANAGER_HEADER = "Law Book Manager";
const PARAGRAPH_MANAGER_CATEGORY = "Category";
const PARAGRAPH_MANAGER_TITLE = "Title";
const PARAGRAPH_MANAGER_DESC = "Description";
const PARAGRAPH_MANAGER_SEND = "Send";
const PARAGRAPH_MANAGER_ADD = "Add a paragraph";
const PARAGRAPH_MANAGER_ERROR = "Your paragraph entry was not successful!";
const PARAGRAPH_MANAGER_DONE = "Your paragraph entry was successful!";
const PARAGRAPH_MANAGER_DISCORD = "Your paragraph entry was successful!";
const PARAGRAPH_HEADER = "Law Book";

// ************************************************************************************//
// * English Language Section - Training
// ************************************************************************************//
const TRAIN_HEADER = "Trainings";
const TRAIN_ADD_HEADER = "Add training";
const TRAIN_ADD_TITLE = "Title";
const TRAIN_ADD_CONTENT = "training content";
const TRAIN_ADD_PERSON = "Affected Units";
const TRAIN_ADD_WHEN = "When?";
const TRAIN_ADD_TYPE = "training type";
const TRAIN_ADD_ERROR = "Your training announcement could not be created!";
const TRAIN_ADD_DONE = "You have announced a new apprenticeship!";
const TRAIN_ADD_DISCORD_NOTES = "A new course has been announced!";
const TRAIN_ADD_SAVE = "announce now";
const TRAIN_ADD_EDIT = "edit training";
const TRAIN_ADD_VIEW = "view training";
const TRAIN_ADD = "add training";
const TRAIN_PRINT = "print training";

// ************************************************************************************//
// * English Language Section - Patrol Duty
// ************************************************************************************//
const PDUTY_HEADER = "Patrol Service";
const PDUTY_ADD_HEADER = "Add Patrol Duty";
const PDUTY_ADD_PERSONS = "Patrol Service Number";
const PDUTY_ADD_PERSONS_UNIT_1 = "Unit 1";
const PDUTY_ADD_PERSONS_UNIT_2 = "Unit 2";
const PDUTY_ADD_ERROR = "Your patrol duty could not be created!";
const PDUTY_ADD_DONE = "You have patrol duty a new created!";
const PDUTY_ADD_DISCORD_NOTES = "A new patrol service has been created!";
const PDUTY_ADD_SAVE = "Save Patrol Duty";
const PDUTY_ADD_EDIT = "Edit Patrol Duty";
const PDUTY_ADD_DELETE = "Delete All Patrol Dutys";
const PDUTY_ADD_DELETE_NOTES = "You have successfully deleted the patrol service!";
const PDUTY_ADD = "Add Patrol Duty";

// ************************************************************************************//
// * English Language Section - Faction Members Change
// ************************************************************************************//
const CHIEF_USERCAHNEGED = "Edit Citizen";
const CHIEF_USERCONTROL = "Employee list";
const CHIEF_USERCONTROLUSERNAME = "Employee name";
const CHIEF_USERCONTROLQUIT = "Relieve employee";
const CHIEF_USERCONTROLQUIT_NOTE = "Fire employee from the LSPD?";
const CHIEF_USERCONTROLQUIT_DONE = "You fired the employee from the LSPD!";
const CHIEF_USERCONTROLQUIT_ERROR = "Unfortunately, you couldn't fire the employee!";
const CHIEF_USERCONTROL_RANK = "Faction Rank";
const CHIEF_USERCONTROLOPTION = "Options";
const CHIEF_USERCONTROLSAVE = "Save";
const CHIEF_CHANGE_USER = "edit";

// ************************************************************************************//
// * English Language Section - Main Site Settings 
// ************************************************************************************//
const SITECONFIG_HEADER = "Site Settings";
const SITECONFIG_ONLINE = "Site Online Status";
const SITECONFIG_NAME = "Site Name";
const SITECONFIG_DONE = "<strong>Success!</strong> The site settings have been saved successfully!";
const SITECONFIG_ERROR = "<strong>Error!</strong> The site settings were not saved successfully!";
const SITECONFIG_THEMES = "Themes";
const SITECONFIG_THEMES_INFO = "Choose the theme you want to use.";
const SITECONFIG_THEMES_BLACK = "dark";
const SITECONFIG_THEMES_BLUE = "light";
const SITECONFIG_ONLINE_INFO = "Choose the online status you want to use.";
const SITECONFIG_ONLINE_ONLINE = "Online";
const SITECONFIG_ONLINE_OFFLINE = "Offline";
const SITECONFIG_CLIENT_YES = "Yes";
const SITECONFIG_CLIENT_NO = "No";
const SITECONFIG_UPGRADE_NOTE = "Upgrade notice";
const SITECONFIG_UPGRADE_NOTE_INFO = "Choose the upgrade display you want to use.";
const SITECONFIG_LANG = "UCP Language";
const SITECONFIG_SAVE = "Save";

// ************************************************************************************//
// * English Language Section - Message System 
// ************************************************************************************//
const MSG_1 = "You should look at this first: <a href='/vendor/webcp/login/index.php'>login</a>!";
const MSG_2 = "You are not a supporter!";
const MSG_8 = "<b>You have successfully edited your account!</b>";
const MSG_9 = "<b>Your registration is complete!</b>";
const MSG_10 = "<b>Please fill in both fields, the username and the password!</b>";
const MSG_11 = "<b>Wrong password!</b>";
const MSG_13 = "<b>E-Mail is not valid!</b>";
const MSG_14 = "<b>Username is not valid!</b>";
const MSG_15 = "<b>Password must be between 5 and 20 characters long!</b>";
const MSG_16 = "<b>Account already exists</b>";
const MSG_17 = "<b>Your logout was successful!</b>";
const MSG_26 = "<b>Your rank is not unlocked for this page!</b>";
const MSG_27 = "<b>Your login was successful!</b>";

// ************************************************************************************//
// * English Language Section - My Profile Change
// ************************************************************************************//
const SIGNATUR = "Signature";
const AVATAR = "Avatar url";
const MYPROFILESAVE = "Save";
const LANGUAGE = "Website language";
const CHANGE_MYPROFILE_LANGUAGENOTE = "Please select";
const CHANGE_MYPROFILE_LANGUAGE_SELECT_EN = "English";
const CHANGE_MYPROFILE_LANGUAGE_SELECT_DE = "German";

// ************************************************************************************//
// * English Language Section - News System
// ************************************************************************************//
const NEWS_HEADER = "News";
const NEWS_INFO = "You have to fill in all fields!";
const NEWS_TITLE_EN = "English title";
const NEWS_TITLE_EN_TEXT = "The English title";
const NEWS_TITLE_DE = "German title";
const NEWS_TITLE_DE_TEXT = "The German title";
const NEWS_CONTENT_EN = "Englisch content";
const NEWS_CONTENT_EN_TEXT = "English content";
const NEWS_CONTENT_DE = "German content";
const NEWS_CONTENT_DE_TEXT = "German content";
const NEWS_DONE = "German content";
const NEWS_SAVE = "Save";

// ************************************************************************************//
// * English Language Section - No Logged & Logged Section
// ************************************************************************************//
const REGISTER = "Register";
const LOGIN = "Login";
const LOGIN_HOME = "Go to";
const REGISTER_HOME = "Go to";
const LOGOUT = "Logout";
const USERNAME = "Username";
const CHARNAME = "Character Name";
const EMAIL = "E-Mail";
const PASSWORD = "Password";
const FACTION_RANK = "Faction Rank";
const NOTE3 = "<b>Note:</b> Don't have an account ?";
const NOTE4 = "<b>Note:</b> You have an account ?";
const INFO1 = "Enter Username";
const INFO2 = "Enter Password";
const INFO4 = "Enter E-Mail Address";
const INFO5 = "Enter Character Name";
const PROFILE_SETTINGS = "Settings";
const PROFILE_ABOUT = "About";
const PROFILE_PORTFOLIO_WEBSITE = "Website";
const PROFILE_PORTFOLIO_DISCORDTAG = "Discord Tags";

// ************************************************************************************//
// * English Language Section - Staff Member 
// ************************************************************************************//
const STAFF_USERCONTROLSAVE = "Save";

// ************************************************************************************//
// * English Language Section - BB-Code-Editor System
// ************************************************************************************//
const BBCODE_EDITOR = "Quote";
const BBCODE_EDITOR_INFO = "1 wrote:";

// ************************************************************************************//
// * German Language Section - Customs
// ************************************************************************************//
const CUSTOMS_HEADER_ICONS = "Icon Examples";

// ************************************************************************************//
// * German Language Section - Webmaster Section
// ************************************************************************************//
const TLIST_WEBMASTER = "Webmaster";