
let videosContainer = document.getElementById('videos-container');
let videoCard = "";

fetch("assets/videos.json") // Replace "your_api_url_here" with the URL of your API
    .then(response => response.json())
    .then(videos => {
        videos.forEach(video => {
            videoCard += `
                <div class="flex flex-col space-y-3 cursor-pointer">
                    <!-- thumbnail -->
                    <a href="${video.thumbnail}">
                        <div class="relative h-52 sm:h-36 w-full">
                            <img class="relative h-full w-full object-cover" src="${video.thumbnail}" alt="" draggable="false">
                            <span class="absolute right-1 bottom-1 p-0.5 px-1 rounded-sm bg-black text-white text-xs bg-opacity-70">${video.duration}</span>
                        </div>
                    </a>
                    <!-- video details -->
                    <div class="flex flex-col flex-auto space-y-1.5 mb-3">
                        <div class="flex items-center space-x-3">
                            <!-- channel logo -->
                            <img class="w-12 h-12 rounded-full object-cover" src="${video.channelPicture}" alt="" draggable="false">
                            <div class="flex items-start">
                                <a href="#" class="text-sm text-bold text-white pr-1">${video.title}</a>
                                <i class="material-icons text-white md-21">more_vert</i>
                            </div>
                        </div>
                        <!-- channel link and meta data -->
                        <div class="flex flex-col pl-1 sm:pl-0 ml-14">
                            <a href="#" class="text-gray-400 text-sm hover:text-white">${video.channelName}</a>
                            <div class="flex space-x-1">
                                <span class="text-sm text-gray-400">${video.views} views</span>
                                <!-- Assuming "uploadedDateTime" is in ISO format -->
                                <span class="text-sm text-gray-400">• ${formatDate(video.uploadedDateTime)} ago</span>
                            </div>
                        </div>
                    </div>
                </div>`;
        });
        videosContainer.innerHTML = videoCard;
    });

// Function to format date
function formatDate(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diff = now - date;
    const hours = Math.floor(diff / (1000 * 60 * 60));
    if (hours < 24) {
        return `${hours} hours`;
    } else {
        const days = Math.floor(hours / 24);
        return `${days} days`;
    }


}

// Add event listeners to category buttons
document.querySelectorAll('.tag-button').forEach(button => {
    button.addEventListener('click', () => {
        const category = button.getAttribute('data-category');
        filterVideosByCategory(category);
    });
});

// Function to filter videos by category
function filterVideosByCategory(category) {
    const videos = document.querySelectorAll('.flex.flex-col.space-y-3.cursor-pointer');
    videos.forEach(video => {
        const videoCategory = video.getAttribute('data-category');
        if (category === 'all' || videoCategory === category) {
            video.style.display = 'block';
        } else {
            video.style.display = 'none';
        }
    });
}



fetch("assets/videos.json") // Replace "your_api_url_here" with the URL of your API
    .then(response => response.json())
    .then(videos => {
        videos.forEach(video => {
            videoCard += `
                <div class="flex flex-col space-y-3 cursor-pointer" data-category="${video.category}">
                    <!-- thumbnail -->
                    <a href="${video.thumbnail}">
                        <div class="relative h-52 sm:h-36 w-full">
                            <img class="relative h-full w-full object-cover" src="${video.thumbnail}" alt="" draggable="false">
                            <span class="absolute right-1 bottom-1 p-0.5 px-1 rounded-sm bg-black text-white text-xs bg-opacity-70">${video.duration}</span>
                        </div>
                    </a>
                    <!-- video details -->
                    <div class="flex flex-col flex-auto space-y-1.5 mb-3">
                        <div class="flex items-center space-x-3">
                            <!-- channel logo -->
                            <img class="w-12 h-12 rounded-full object-cover" src="${video.channelPicture}" alt="" draggable="false">
                            <div class="flex items-start">
                                <a href="#" class="text-sm text-bold text-white pr-1">${video.title}</a>
                                <i class="material-icons text-white md-21">more_vert</i>
                            </div>
                        </div>
                        <!-- channel link and meta data -->
                        <div class="flex flex-col pl-1 sm:pl-0 ml-14">
                            <a href="#" class="text-gray-400 text-sm hover:text-white">${video.channelName}</a>
                            <div class="flex space-x-1">
                                <span class="text-sm text-gray-400">${video.views} views</span>
                                <!-- Assuming "uploadedDateTime" is in ISO format -->
                                <span class="text-sm text-gray-400">• ${formatDate(video.uploadedDateTime)} ago</span>
                            </div>
                        </div>
                    </div>
                </div>`;
        });
        videosContainer.innerHTML = videoCard;
    });




