<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}
// Replace these variables with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "9Tube";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/images/icon.ico" type="image/x-icon">
    <title>9TeenInitiative</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="./assets/style.css">

    <style>
        .relative {
            position: relative;
        }


        #profileDropdown {
            width: auto;
            /* Set width to auto to wrap content */
            background-color: black;
            /* Set background color to black */
        }

        #profileDropdown button {
            display: block;
            padding: 0.5rem 1rem;
            /* Adjust padding as needed */
            font-size: 0.875rem;
            /* Set font size */
            color: white;
            /* Set text color to white */
            text-decoration: none;
            /* Remove default underline */
        }

        #profileDropdown button:hover {
            background-color: #333;
            /* Change background color on hover */
        }


        .tags-container {
            position: relative;
            z-index: 1;
            /* Ensure that the tags container appears above other elements */
        }
    </style>

</head>

<body class="body">

    <!-- top fixed navbar -->
    <nav class="bg-topNavBg w-full p-1 fixed top-0 z-20">
        <!-- navbar container -->
        <div class="flex justify-between items-center px-2 sm:px-6 py-1.5 mx-auto">
            <!-- logo container -->
            <div class="flex items-center space-x-3">
                <div class="flex cursor-pointer"><i class="material-icons text-white">menu</i></div>
                <div class="w-22 h-5">
                    <a href="#"><svg class="w-full h-full flex-grow" viewBox="0 0 90 20"
                            preserveAspectRatio="xMidYMid meet" focusable="false">
                            <g viewBox="0 0 90 20" preserveAspectRatio="xMidYMid meet" class="style-scope yt-icon">

                                <g class="style-scope yt-icon">
                                    <image href="./assets/images/icon.ico" x="0" y="0" width="30" height="20" />
                                </g>

                                <g class="style-scope yt-icon">
                                    <g id="youtube-paths" fill="white" class="style-scope yt-icon">

                                        <path
                                            d="M64.4755 3.68758H61.6768V18.5629H58.9181V3.68758H56.1194V1.42041H64.4755V3.68758Z"
                                            class="style-scope yt-icon"></path>
                                        <path
                                            d="M71.2768 18.5634H69.0708L68.8262 17.03H68.7651C68.1654 18.1871 67.267 18.7656 66.0675 18.7656C65.2373 18.7656 64.6235 18.4928 64.2284 17.9496C63.8333 17.4039 63.6357 16.5526 63.6357 15.3955V6.03751H66.4556V15.2308C66.4556 15.7906 66.5167 16.188 66.639 16.4256C66.7613 16.6631 66.9659 16.783 67.2529 16.783C67.4974 16.783 67.7326 16.7078 67.9584 16.5573C68.1842 16.4067 68.3488 16.2162 68.4593 15.9858V6.03516H71.2768V18.5634Z"
                                            class="style-scope yt-icon"></path>
                                        <path
                                            d="M80.609 8.0387C80.4373 7.24849 80.1621 6.67699 79.7812 6.32186C79.4002 5.96674 78.8757 5.79035 78.2078 5.79035C77.6904 5.79035 77.2059 5.93616 76.7567 6.23014C76.3075 6.52412 75.9594 6.90747 75.7148 7.38489H75.6937V0.785645H72.9773V18.5608H75.3056L75.5925 17.3755H75.6537C75.8724 17.7988 76.1993 18.1304 76.6344 18.3774C77.0695 18.622 77.554 18.7443 78.0855 18.7443C79.038 18.7443 79.7412 18.3045 80.1904 17.4272C80.6396 16.5476 80.8653 15.1765 80.8653 13.3092V11.3266C80.8653 9.92722 80.7783 8.82892 80.609 8.0387ZM78.0243 13.1492C78.0243 14.0617 77.9867 14.7767 77.9114 15.2941C77.8362 15.8115 77.7115 16.1808 77.5328 16.3971C77.3564 16.6158 77.1165 16.724 76.8178 16.724C76.585 16.724 76.371 16.6699 76.1734 16.5594C75.9759 16.4512 75.816 16.2866 75.6937 16.0702V8.96062C75.7877 8.6196 75.9524 8.34209 76.1852 8.12337C76.4157 7.90465 76.6697 7.79646 76.9401 7.79646C77.2271 7.79646 77.4481 7.90935 77.6034 8.13278C77.7609 8.35855 77.8691 8.73485 77.9303 9.26636C77.9914 9.79787 78.022 10.5528 78.022 11.5335V13.1492H78.0243Z"
                                            class="style-scope yt-icon"></path>
                                        <path
                                            d="M84.8657 13.8712C84.8657 14.6755 84.8892 15.2776 84.9363 15.6798C84.9833 16.0819 85.0821 16.3736 85.2326 16.5594C85.3831 16.7428 85.6136 16.8345 85.9264 16.8345C86.3474 16.8345 86.639 16.6699 86.7942 16.343C86.9518 16.0161 87.0365 15.4705 87.0506 14.7085L89.4824 14.8519C89.4965 14.9601 89.5035 15.1106 89.5035 15.3011C89.5035 16.4582 89.186 17.3237 88.5534 17.8952C87.9208 18.4667 87.0247 18.7536 85.8676 18.7536C84.4777 18.7536 83.504 18.3185 82.9466 17.446C82.3869 16.5735 82.1094 15.2259 82.1094 13.4008V11.2136C82.1094 9.33452 82.3987 7.96105 82.9772 7.09558C83.5558 6.2301 84.5459 5.79736 85.9499 5.79736C86.9165 5.79736 87.6597 5.97375 88.1771 6.32888C88.6945 6.684 89.059 7.23433 89.2707 7.98457C89.4824 8.7348 89.5882 9.76961 89.5882 11.0913V13.2362H84.8657V13.8712ZM85.2232 7.96811C85.0797 8.14449 84.9857 8.43377 84.9363 8.83593C84.8892 9.2381 84.8657 9.84722 84.8657 10.6657V11.5641H86.9283V10.6657C86.9283 9.86133 86.9001 9.25221 86.846 8.83593C86.7919 8.41966 86.6931 8.12803 86.5496 7.95635C86.4062 7.78702 86.1851 7.7 85.8864 7.7C85.5854 7.70235 85.3643 7.79172 85.2232 7.96811Z"
                                            class="style-scope yt-icon"></path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </a>
                </div>
            </div>
            <!-- search container -->
            <div class="hidden md:flex items-center space-x-2 w-1/2">
                <!-- input box -->
                <div class="flex items-center flex-auto justify-between rounded border border-sideBarHoverBg">
                    <input
                        class="bg-searchBarBg w-full rounded-l outline-none border-none p-0.5 pl-3 text-white placeholder-gray-500"
                        type="text" placeholder="Search">

                    <i
                        class="material-icons md-21 text-center rounded-r text-gray-300 hover:text-white p-1 w-20 bg-searchIconBg cursor-pointer">search</i>
                </div>
                <div class="flex items-center justify-center w-9 h-9 rounded-full bg-mainBg cursor-pointer">
                    <i class="material-icons text-white">mic</i>
                </div>
            </div>

            <!-- right icons container  -->
            <div class="flex items-center space-x-3 sm:space-x-6 pr-4">
                <i class="material-icons text-white cursor-pointer">video_call</i>
                <i class="material-icons text-white cursor-pointer">apps</i>
                <i class="material-icons text-white cursor-pointer">notifications</i>

                <div class="relative">
                    <img class="w-9 h-9 rounded-full object-cover cursor-pointer" src="./assets/images/hero.png" alt=""
                        draggable="false" id="profileImage">

                    <!-- Dropdown menu -->
                    <div class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg hidden z-10"
                        id="profileDropdown">

                        <button onclick="location.href='edit_profile.php';">Edit Profile</button>

                        <button onclick="location.href='generate_link.php';">Invite</button>

                        <form action="logout.php" method="POST">
                            <button type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </nav>
    <!-- navbar ends here -->

    <!-- main container -->
    <div class="flex flex-row">
        <!-- left sidebar fixed -->
        <div class="sidebar" id="sideBar">
            <!-- main home explore btns -->
            <div class="flex flex-col w-full mb-2">
                <div class="flex items-center space-x-5 bg-sideBarHoverBg px-7 py-2.5 cursor-pointer">
                    <i class="material-icons text-white md-21">home</i>
                    <h2 class="text-sm font-semibold text-white">Home</h2>
                </div>

                <div class="flex items-center space-x-5 hover:bg-sideBarHoverBg px-7 py-2.5 cursor-pointer">
                    <i class="material-icons text-gray-400 md-21">explore</i>
                    <h2 class="text-sm text-white">Explore</h2>
                </div>

                <div class="flex items-center space-x-5 hover:bg-sideBarHoverBg px-7 py-2.5 cursor-pointer">
                    <i class="material-icons text-gray-400 md-21">watch_later</i>
                    <h2 class="text-sm text-white">Watch Later</h2>
                </div>

                <div class="flex items-center space-x-5 hover:bg-sideBarHoverBg px-7 py-2.5 cursor-pointer">
                    <i class="material-icons text-gray-400 md-21">video_library</i>
                    <h2 class="text-sm text-white">Library</h2>
                </div>

                <div class="flex items-center space-x-5 hover:bg-sideBarHoverBg px-7 py-2.5 cursor-pointer">
                    <i class="material-icons text-gray-400 md-21">history</i>
                    <h2 class="text-sm text-white">History</h2>
                </div>

                <div class="flex items-center space-x-5 hover:bg-sideBarHoverBg px-7 py-2.5 cursor-pointer">
                    <i class="material-icons text-gray-400 md-21">settings</i>
                    <h2 class="text-sm text-white">Settings</h2>
                </div>

                <div class="flex items-center space-x-5 hover:bg-sideBarHoverBg px-7 py-2.5 cursor-pointer">
                    <i class="material-icons text-gray-400 md-21">flag</i>
                    <h2 class="text-sm text-white">Report history</h2>
                </div>

                <div class="flex items-center space-x-5 hover:bg-sideBarHoverBg px-7 py-2.5 cursor-pointer">
                    <i class="material-icons text-gray-400 md-21">help</i>
                    <h2 class="text-sm text-white">Help</h2>
                </div>

                <div class="flex items-center space-x-5 hover:bg-sideBarHoverBg px-7 py-2.5 cursor-pointer">
                    <i class="material-icons text-gray-400 md-21">feedback</i>
                    <h2 class="text-sm text-white">Send feedback</h2>
                </div>

            </div>

            <!-- library history btns -->
            <div class="flex flex-col w-full mb-2 mt-3">
                <h2 class="uppercase text-sm px-7 py-1.5 text-gray-400">subscriptions</h2>

            </div>

            <!-- settings support btns -->
            <div class="flex flex-col w-full mb-2 mt-3">

            </div>

            <div class="border border-searchIconBg"></div>

            <!-- about press -->
            <div class="flex flex-col px-6 py-2">
                <div class="flex flex-wrap space-x-2">
                    <a class="text-xs text-gray-400" href="#">About</a>
                    <a class="text-xs text-gray-400" href="#">Press</a>
                    <a class="text-xs text-gray-400" href="#">Copyright</a>
                </div>
                <div class="flex flex-wrap space-x-2">
                    <a class="text-xs text-gray-400" href="#">Contact us</a>
                    <a class="text-xs text-gray-400" href="#">Creator</a>
                    <a class="text-xs text-gray-400" href="#">Advertise</a>
                </div>
                <a class="text-xs text-gray-400" href="#">Developers</a>
            </div>

            <!-- terms privacy -->
            <div class="flex flex-col px-6 py-2">
                <div class="flex flex-wrap space-x-2">
                    <a class="text-xs text-gray-400" href="#">Terms</a>
                    <a class="text-xs text-gray-400" href="#">Privacy</a>
                    <a class="text-xs text-gray-400" href="#">Policy & Safety</a>
                </div>
                <a class="text-xs text-gray-400" href="">How 9Teen Initiative works</a>
                <a class="text-xs text-gray-400" href="">Test new features</a>
            </div>

            <!-- copyright -->
            <span class="text-gray-500 text-xs px-6 py-2">&copy; 2024 9Teen Initiative</span>

        </div>

        <!-- main videos container -->
        <div class="flex flex-col lg:ml-60 w-full lg:w-4/5 xl:w-5/6">

            <!-- tags pills fixed navbar -->
            <div class="tags-container">

                <!-- one pill -->
                <a href="#" class="text-sm bg-white py-1.5 px-3 rounded-full text-black active tag-button"
                    data-category="all">All</a>
                <a href="#"
                    class="text-sm bg-pillsBg hover:bg-gray-700 py-1 px-3 rounded-full text-white border border-gray-700 transition duration-150 tag-button"
                    data-category="gaming">Gaming</a>
                <a href="#"
                    class="text-sm bg-pillsBg hover:bg-gray-700 py-1 px-3 rounded-full text-white border border-gray-700 transition duration-150 tag-button"
                    data-category="music">Music</a>
                <a href="#"
                    class="text-sm bg-pillsBg hover:bg-gray-700 py-1 px-3 rounded-full text-white border border-gray-700 transition duration-150 tag-button"
                    data-category="tech">Tech</a>

            </div>

            <!-- videos container grid layout -->
            <div class="videos-container" id="videos-container">
                <!-- one video card -->
                <div class="flex flex-col space-y-3 cursor-pointer">
                    <!-- thumbnail -->
                    <a href="#">
                        <div class="relative h-52 sm:h-36 w-full">
                            <img class="relative h-full w-full object-cover" src="../public/assests/images/ganesh.jpg"
                                alt="">
                            <span
                                class="absolute right-1 bottom-1 p-0.5 px-1 rounded-sm bg-black text-white text-xs bg-opacity-70">38:38</span>
                        </div>
                    </a>
                    <!-- video details -->
                    <div class="flex flex-col flex-auto space-y-1.5 mb-3">

                        <div class="flex items-center space-x-3">
                            <!-- channel logo -->
                            <img class="w-12 h-12 rounded-full object-cover cursor-pointer"
                                src="./assets/images/hero.png" alt="">
                            <div class="flex items-start">
                                <a href="#" class="text-sm text-bold text-white pr-1">Lorem ipsum dolor sit amet
                                    consectetur adipisicing.</a>
                                <i class="material-icons text-white md-21">more_vert</i>
                            </div>
                        </div>

                        <!-- channel link and meta data -->
                        <div class="flex flex-col pl-1 sm:pl-0 ml-14">
                            <a href="" class="text-gray-400 text-sm hover:text-white">Jhon Doe</a>
                            <div class="flex space-x-1">
                                <span class="text-sm text-gray-400">74K views</span>
                                <span class="text-sm text-gray-400">• 1 month ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="./assets/script.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const profileImage = document.getElementById("profileImage");
            const profileDropdown = document.getElementById("profileDropdown");

            profileImage.addEventListener("click", function () {
                profileDropdown.classList.toggle("hidden");
            });

            // Close the dropdown when clicking outside
            document.addEventListener("click", function (event) {
                if (!profileImage.contains(event.target) && !profileDropdown.contains(event.target)) {
                    profileDropdown.classList.add("hidden");
                }
            });
        });
    </script>


</body>

</html>