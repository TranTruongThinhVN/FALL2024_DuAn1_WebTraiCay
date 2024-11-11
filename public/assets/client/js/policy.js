document.addEventListener("DOMContentLoaded", () => {
    const links = document.querySelectorAll(".sidebar a");
    const sections = document.querySelectorAll(".section-content");

    links.forEach(link => {
        link.addEventListener("click", (e) => {
            e.preventDefault();

            // Xóa class `active` khỏi tất cả các phần
            sections.forEach(section => section.classList.remove("active"));

            // Thêm class `active` vào phần được nhấp
            const sectionId = link.getAttribute("data-section");
            document.getElementById(sectionId).classList.add("active");
        });
    });
});


document.addEventListener("DOMContentLoaded", () => {
    const sidebarLinks = document.querySelectorAll(".sidebar a");

    sidebarLinks.forEach(link => {
        link.addEventListener("click", (e) => {
            // Ngăn chặn hành vi mặc định của liên kết
            e.preventDefault();

            // Xóa lớp `active` khỏi tất cả các liên kết
            sidebarLinks.forEach(link => link.classList.remove("active"));

            // Thêm lớp `active` vào liên kết được nhấp
            link.classList.add("active");

            // Tìm và hiển thị phần nội dung tương ứng
            const sectionId = link.getAttribute("data-section");
            document.querySelectorAll(".section-content").forEach(section => {
                section.classList.remove("active");
            });
            document.getElementById(sectionId).classList.add("active");
        });
    });
});

