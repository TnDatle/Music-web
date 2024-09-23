function searchSongs() {
    const searchValue = document.getElementById('search-box').value;
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('music-list').innerHTML = xhr.responseText;
            // Cập nhật lại sự kiện click cho các nút phát nhạc mới
            updatePlayButtonEvents();
        }
    };

    xhr.open('GET', 'timkiem.php?search_term=' + encodeURIComponent(searchValue), true);
    xhr.send();
}

function updatePlayButtonEvents() {
    // Lặp qua tất cả các nút phát nhạc và gắn lại sự kiện click cho chúng
    const playButtons = document.getElementsByClassName('play');
    for (let i = 0; i < playButtons.length; i++) {
        playButtons[i].addEventListener('click', playMusic);
    }
}

function playMusic() {
    var musicId = button.getAttribute('data-id');
    // Xử lý phát nhạc khi nút phát nhạc được nhấp
    // Đảm bảo rằng bạn có thể lấy ID của bài hát từ thuộc tính data-id của nút phát nhạc
}
