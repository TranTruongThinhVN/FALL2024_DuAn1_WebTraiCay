const provinceUrl = "https://open.oapi.vn/location/provinces?page=0&size=30";

// Lấy thông tin tỉnh thành
fetch(provinceUrl)
  .then((response) => {
    if (!response.ok) {
      throw new Error("Yêu cầu thất bại");
    }
    return response.json(); // Chuyển đổi kết quả trả về thành JSON
  })
  .then((data) => {
    const provinceList = document.getElementById("province-list");
    if (data && data.data && Array.isArray(data.data)) {
      data.data.forEach((province) => {
        const option = document.createElement("option");
        option.value = province.id; // Gán ID của tỉnh thành làm giá trị
        option.textContent = province.name; // Tên tỉnh thành
        provinceList.appendChild(option); // Thêm option vào select
      });
    } else {
      console.error("Dữ liệu không hợp lệ");
    }
  })
  .catch((error) => {
    console.error("Lỗi:", error);
  });

// Lắng nghe sự kiện khi người dùng chọn tỉnh thành
document
  .getElementById("province-list")
  .addEventListener("change", function () {
    const provinceId = this.value; // Lấy ID của tỉnh thành đã chọn
    const districtList = document.getElementById("district-list");
    const wardList = document.getElementById("ward-list");

    // Xóa các tùy chọn cũ trong quận/huyện và phường/xã
    districtList.innerHTML = "<option selected disabled>Quận / Huyện</option>";
    wardList.innerHTML = "<option selected disabled>Phường / Xã</option>";

    // Gọi API để lấy danh sách quận/huyện
    const districtUrl = `https://open.oapi.vn/location/districts/${provinceId}?page=0&size=30`;
    fetch(districtUrl)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Yêu cầu thất bại");
        }
        return response.json();
      })
      .then((districtData) => {
        if (
          districtData &&
          districtData.data &&
          Array.isArray(districtData.data)
        ) {
          districtData.data.forEach((district) => {
            const option = document.createElement("option");
            option.value = district.id; // Gán ID của quận/huyện làm giá trị
            option.textContent = district.name; // Tên quận/huyện
            districtList.appendChild(option); // Thêm option vào select
          });
        } else {
          console.error("Dữ liệu quận/huyện không hợp lệ");
        }
      })
      .catch((error) => {
        console.error("Lỗi khi gọi API quận/huyện:", error);
      });

    // Gửi yêu cầu lưu tỉnh đã chọn vào cơ sở dữ liệu (Backend)
    fetch("http://yourdomain.com/provinceController/fetchAndInsertDistricts", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ provinceId: provinceId }),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log("Dữ liệu đã được lưu:", data);
      })
      .catch((error) => {
        console.error("Lỗi khi gửi dữ liệu:", error);
      });
  });

// Lắng nghe sự kiện khi người dùng chọn quận/huyện
document
  .getElementById("district-list")
  .addEventListener("change", function () {
    const districtId = this.value; // Lấy ID của quận/huyện đã chọn
    const wardList = document.getElementById("ward-list");

    // Xóa các tùy chọn cũ trong phường/xã
    wardList.innerHTML = "<option selected disabled>Phường / Xã</option>";

    // Gọi API để lấy danh sách phường/xã
    const wardUrl = `https://open.oapi.vn/location/wards/${districtId}?page=0&size=30`;
    fetch(wardUrl)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Yêu cầu thất bại");
        }
        return response.json();
      })
      .then((wardData) => {
        if (wardData && wardData.data && Array.isArray(wardData.data)) {
          wardData.data.forEach((ward) => {
            const option = document.createElement("option");
            option.value = ward.id; // Gán ID của phường/xã làm giá trị
            option.textContent = ward.name; // Tên phường/xã
            wardList.appendChild(option); // Thêm option vào select
          });
        } else {
          console.error("Dữ liệu phường/xã không hợp lệ");
        }
      })
      .catch((error) => {
        console.error("Lỗi khi gọi API phường/xã:", error);
      });

    // Gửi yêu cầu lưu quận/huyện đã chọn vào cơ sở dữ liệu (Backend)
    fetch("http://yourdomain.com/provinceController/fetchAndInsertWards", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ districtId: districtId }),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log("Dữ liệu quận đã được lưu:", data);
      })
      .catch((error) => {
        console.error("Lỗi khi gửi dữ liệu quận:", error);
      });
  });
