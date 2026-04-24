# 📊 PHÂN TÍCH CHI TIẾT WEBSITE E-COMMERCE

## I. TRANG CÔNG KHAI (PUBLIC PAGES)

### 1. **Trang Chủ (index.php)**
- **Mô tả**: Trang chính của website với banner carousel, danh sách sản phẩm theo danh mục
- **File liên quan**: 
  - `index.php` - File chính
  - `includes/headerNav.php` - Header navigation
  - `includes/desktopnav.php` - Desktop menu
  - `includes/mobilenav.php` - Mobile menu
  - `includes/topheadactions.php` - Search bar, user account
  - `functions/functions.php` - Database functions
- **Các hành động người dùng**:
  - Xem banner carousel (khuyến mãi, sản phẩm nổi bật)
  - Lọc sản phẩm theo danh mục (Men, Women, Kids, Electronics, v.v.)
  - Tìm kiếm sản phẩm
  - Xem hàng sản phẩm (New Arrivals, Trending Products, Top Rated Products)
  - Truy cập vào chi tiết sản phẩm
  - Thêm sản phẩm vào giỏ hàng
- **Dữ liệu hiển thị**:
  - Banner products
  - Category bar products
  - New arrivals (8 sản phẩm)
  - Trending products (8 sản phẩm)
  - Top rated products (8 sản phẩm)

### 2. **Trang Chi Tiết Sản Phẩm (viewdetail.php)**
- **Mô tả**: Hiển thị thông tin chi tiết của một sản phẩm cụ thể
- **File liên quan**:
  - `viewdetail.php` - File chính
  - `product.php` - Image viewer với magnifier (phóng to ảnh)
  - `manage_cart.php` - Xử lý thêm vào giỏ
  - `functions/functions.php` - `get_product()`, `get_deal_of_day_by_id()`
- **Các hành động người dùng**:
  - Xem ảnh sản phẩm (có chức năng phóng to)
  - Xem giá, giá giảm, rating
  - Xem mô tả chi tiết
  - Nhập số lượng
  - Thêm vào giỏ hàng (Add to Cart)
  - Xem sản phẩm liên quan
- **Tính năng đặc biệt**:
  - Image magnifier glass - phóng to ảnh sản phẩm lên 2x khi di chuột

### 3. **Trang Danh Mục (category.php)**
- **Mô tả**: Hiển thị tất cả sản phẩm trong một danh mục
- **File liên quan**:
  - `category.php` - File chính
  - `includes/categorysidebar.php` - Sidebar lọc danh mục
  - `functions/functions.php` - `get_items_by_category_items()`
- **Các hành động người dùng**:
  - Chọn danh mục từ URL parameter (`?category=men`)
  - Xem danh sách sản phẩm theo danh mục
  - Xem badge discount/sale
  - Nhấp vào sản phẩm để xem chi tiết
  - Thêm vào giỏ hàng
- **Danh mục được hỗ trợ**: men, women, kids, electronics, home, sports, beauty, furniture, books, stationary, grocery, other

### 4. **Trang Tìm Kiếm (search.php)**
- **Mô tả**: Tìm kiếm sản phẩm theo từ khóa
- **File liên quan**:
  - `search.php` - File chính
  - `functions/functions.php` - Database queries
- **Các hành động người dùng**:
  - Nhập từ khóa tìm kiếm
  - Tìm theo tên sản phẩm hoặc danh mục
  - Hỗ trợ tìm kiếm từ múp từ (từ được tách bằng dấu cách)
  - Phân trang kết quả (8 sản phẩm/trang)
  - Xem ảnh, giá, rating của kết quả
- **Logic tìm kiếm**:
  - Nếu 2+ từ: tìm kiếm kết hợp (title LIKE từ 1 AND category LIKE từ 2)
  - Nếu 1 từ: tìm kiếm OR (title LIKE hoặc category LIKE)
  - Hạn chế SQL injection bằng `real_escape_string()`

### 5. **Trang Đăng Nhập (login.php)**
- **Mô tả**: Đăng nhập cho khách hàng
- **File liên quan**:
  - `login.php` - File chính
  - `includes/config.php` - Kết nối database
  - `functions/functions.php` - Thực hiện đăng nhập
- **Các hành động người dùng**:
  - Nhập email
  - Nhập mật khẩu
  - Chọn "Remember Me"
  - Nhấp "Sign in" để đăng nhập
  - Nhấp "Sign up" để chuyển đến trang đăng ký
- **Xác thực**:
  - Kiểm tra email và password trong bảng `customer`
  - Nếu đã đăng nhập → chuyển hướng đến profile
  - Hiển thị lỗi nếu không đúng

### 6. **Trang Đăng Ký (signup.php)**
- **Mô tả**: Tạo tài khoản mới cho khách hàng
- **File liên quan**:
  - `signup.php` - Form đăng ký
  - `includes/signup.inc.php` - Xử lý logic
  - `includes/signupFn.inc.php` - Kiểm tra validation
- **Các hành động người dùng**:
  - Nhập họ tên
  - Nhập số điện thoại
  - Nhập email
  - Nhập địa chỉ
  - Nhập mật khẩu
  - Xác nhận mật khẩu
  - Nhấp "Register" để tạo tài khoản
- **Kiểm tra Validation**:
  - Tất cả trường bắt buộc
  - Số điện thoại hợp lệ
  - Email hợp lệ
  - Mật khẩu trùng khớp
  - Email chưa tồn tại trong hệ thống
- **Lưu vào DB**: Bảng `customer` (customer_fname, customer_email, customer_phone, customer_address, customer_pwd)

### 7. **Trang Hồ Sơ (profile.php)**
- **Mô tả**: Hiển thị thông tin hồ sơ của người dùng đã đăng nhập
- **File liên quan**:
  - `profile.php` - File chính
  - `includes/headerNav.php` - Lấy thông tin user từ session
- **Yêu cầu**: Phải đăng nhập (kiểm tra `$_SESSION['id']`)
- **Các hành động người dùng**:
  - Xem thông tin cá nhân (Tên, Email, Điện thoại, Địa chỉ)
  - Xem vai trò (Admin hoặc User bình thường)
  - Nhấp "Edit" để chỉnh sửa thông tin
  - Xem lịch sử đơn hàng
  - Quản lý địa chỉ
  - Quản lý liên hệ
- **Dữ liệu hiển thị**:
  - Tên: `$_SESSION['customer_name']`
  - Email: `$_SESSION['customer_email']`
  - Số điện thoại: `$_SESSION['customer_phone']`
  - Địa chỉ: `$_SESSION['customer_address']`
  - Vai trò: `$_SESSION['customer_role']`

### 8. **Trang Giỏ Hàng (cart.php)**
- **Mô tả**: Hiển thị các sản phẩm đã thêm vào giỏ hàng
- **File liên quan**:
  - `cart.php` - File chính
  - `manage_cart.php` - Xử lý thêm/xóa sản phẩm
  - `functions/functions.php` - Database functions
- **Các hành động người dùng**:
  - Xem danh sách sản phẩm trong giỏ (Ảnh, Tên, Giá, Số lượng)
  - Xóa sản phẩm khỏi giỏ
  - Thay đổi số lượng
  - Nhấp "Proceed To CheckOut" để thanh toán
- **Lưu trữ**: Session `$_SESSION['mycart']` (array of products)
- **Nếu giỏ trống**: Hiển thị "No item available in cart"

### 9. **Trang Thanh Toán (checkout.php)**
- **Mô tả**: Form nhập thông tin giao hàng và xác nhận đơn hàng
- **File liên quan**:
  - `checkout.php` - Form thanh toán
  - `payment.php` - Xử lý thanh toán Stripe
  - `success.php` - Xác nhận thành công
- **Các hành động người dùng**:
  - Nhập thông tin giao hàng:
    - Họ tên (First Name, Last Name)
    - Số nhà (House Number)
    - Tên đường (Street)
    - Thành phố (Town/City)
    - Mã bưu điện (Post Code)
    - Quốc gia (Country)
    - Số điện thoại
    - Email
  - Nhấp "Proceed to Checkout" để thanh toán
- **Yêu cầu**: Phải đăng nhập và có sản phẩm trong giỏ

### 10. **Trang Liên Hệ (contact.php)**
- **Mô tả**: Hiển thị thông tin liên hệ của website
- **File liên quan**:
  - `contact.php` - File chính
  - Admin settings (email, số điện thoại, địa chỉ)
- **Các hành động người dùng**:
  - Xem thông tin liên hệ:
    - Email (có link mailto)
    - WhatsApp (số điện thoại)
    - Địa chỉ (có Google Maps embedded)
  - Xem bản đồ vị trí trên Google Maps

### 11. **Trang Giới Thiệu (about.php)**
- **Mô tả**: Giới thiệu về website E-Commerce
- **File liên quan**:
  - `about.php` - File chính
- **Các hành động người dùng**:
  - Đọc thông tin giới thiệu về công ty
  - Xem tên website từ Admin settings
  - Đọc mô tả sứ mệnh của website

### 12. **Trang Logout (logout.php)**
- **Mô tả**: Đăng xuất người dùng
- **File liên quan**:
  - `logout.php` - File chính
- **Các hành động**:
  - Xóa SESSION
  - Xóa SESSION data
  - Chuyển hướng về trang chủ

### 13. **Trang Success (success.php)**
- **Mô tả**: Xác nhận thanh toán thành công
- **File liên quan**:
  - `success.php` - File chính
  - Lấy `session_id` từ Stripe
- **Các hành động**:
  - Lấy thông tin session từ Stripe API
  - Kiểm tra status thanh toán
  - Tạo Order mới trong database
  - Lưu order items
  - Xóa giỏ hàng
  - Chuyển hướng về trang chủ

---

## II. TRANG QUẢN TRỊ (ADMIN PAGES)

### 1. **Admin Đăng Nhập (admin/login.php)**
- **Mô tả**: Đăng nhập cho admin
- **File liên quan**:
  - `admin/login.php` - Form đăng nhập
  - `admin/includes/config.php` - Database config
- **Các hành động admin**:
  - Nhập email
  - Nhập password
  - Nhấp "Sign in"
- **Xác thực**:
  - Kiểm tra email và password trong bảng `customer`
  - Kiểm tra `customer_role = 'admin'`
  - Tạo session `$_SESSION['logged-in'] = '1'`
  - Chuyển hướng đến trang quản lý sản phẩm

### 2. **Quản Lý Sản Phẩm (admin/post.php)**
- **Mô tả**: Danh sách tất cả sản phẩm (để quản lý)
- **File liên quan**:
  - `admin/post.php` - File chính
  - `admin/update-post.php` - Chỉnh sửa sản phẩm
  - `admin/remove-post.php` - Xóa sản phẩm
  - `admin/add-post.php` - Thêm sản phẩm mới
  - `admin/save-post.php` - Lưu sản phẩm mới
- **Các hành động admin**:
  - Xem danh sách tất cả sản phẩm (bảng với cột):
    - S.No (Số thứ tự)
    - Title (Tên sản phẩm)
    - Category (Danh mục)
    - Date (Ngày tạo)
    - Author (Người tạo)
    - Edit (Link chỉnh sửa)
    - Delete (Link xóa)
  - Nhấp "ADD Products" để thêm sản phẩm mới
  - Nhấp icon Edit để chỉnh sửa sản phẩm
  - Nhấp icon Delete để xóa sản phẩm
- **Quyền hạn**:
  - Admin xem: Tất cả sản phẩm
  - Normal user xem: Chỉ sản phẩm của họ

### 3. **Thêm Sản Phẩm Mới (admin/add-post.php)**
- **Mô tả**: Form thêm sản phẩm mới
- **File liên quan**:
  - `admin/add-post.php` - Form
  - `admin/save-post.php` - Xử lý lưu
- **Các hành động admin**:
  - Nhập các thông tin:
    - Title (Tên sản phẩm) - Bắt buộc
    - Price (Giá) - Bắt buộc
    - Discount (Giấu) - Bắt buộc
    - Description (Mô tả) - Bắt buộc
    - No. of Items (Số lượng) - Bắt buộc
    - Category (Danh mục) - Mặc định "All"
    - Image (Ảnh sản phẩm) - Bắt buộc
    - Available (Có sẵn) - Checkbox
  - Nhấp "Add" để thêm sản phẩm
- **Xử lý Upload**:
  - Kiểm tra loại file: jpeg, jpg, png
  - Kiểm tra kích thước: < 2MB
  - Di chuyển file vào folder `admin/upload/`
- **Lưu vào DB**: Bảng `products` (product_catag, product_title, product_price, discounted_price, product_desc, product_date, product_img, product_left, product_author)

### 4. **Chỉnh Sửa Sản Phẩm (admin/update-post.php)**
- **Mô tả**: Chỉnh sửa thông tin sản phẩm đã tồn tại
- **File liên quan**:
  - `admin/update-post.php` - File chính
- **Các hành động admin**:
  - Lấy ID sản phẩm từ URL (`?id=xxx`)
  - Hiển thị form với thông tin hiện tại của sản phẩm
  - Chỉnh sửa các trường:
    - Title
    - Price
    - Discount
    - Description
    - No. of Items
    - Category
    - Image (upload ảnh mới hoặc giữ ảnh cũ)
  - Nhấp "Update" để lưu thay đổi
- **Logic**:
  - Nếu upload ảnh mới: Lưu ảnh mới
  - Nếu không upload: Giữ ảnh cũ
  - Update bảng `products` WHERE product_id

### 5. **Xóa Sản Phẩm (admin/remove-post.php)**
- **Mô tả**: Xóa sản phẩm khỏi database
- **File liên quan**:
  - `admin/remove-post.php` - File chính
- **Các hành động**:
  - Nhấp Delete trên danh sách sản phẩm
  - Xóa record từ bảng `products` WHERE product_id
  - Chuyển hướng về danh sách sản phẩm

### 6. **Quản Lý Người Dùng (admin/users.php)**
- **Mô tả**: Danh sách tất cả người dùng (khách hàng)
- **File liên quan**:
  - `admin/users.php` - File chính
  - `admin/update-user.php` - Chỉnh sửa người dùng
  - `admin/remove-user.php` - Xóa người dùng
- **Các hành động admin**:
  - Xem danh sách người dùng (bảng với cột):
    - S.No
    - Name (Tên)
    - Phone (Điện thoại)
    - Address (Địa chỉ)
    - Role (Vai trò: admin/normal)
    - Edit (Link chỉnh sửa)
    - Delete (Link xóa)
  - Phân trang: 4 người dùng/trang
  - Nhấp Edit để chỉnh sửa thông tin
  - Nhấp Delete để xóa người dùng
- **Dữ liệu**: Lấy từ bảng `customer`

### 7. **Chỉnh Sửa Người Dùng (admin/update-user.php)**
- **Mô tả**: Chỉnh sửa thông tin người dùng
- **File liên quan**:
  - `admin/update-user.php` - File chính
- **Các hành động admin**:
  - Lấy ID người dùng từ URL (`?id=xxx`)
  - Hiển thị form với thông tin hiện tại
  - Chỉnh sửa các trường:
    - Name (Tên)
    - Phone (Điện thoại)
    - Address (Địa chỉ)
    - Role (Vai trò: Admin hoặc Normal)
  - Nhấp "Update" để lưu thay đổi
- **Update**: Bảng `customer` WHERE customer_id

### 8. **Xóa Người Dùng (admin/remove-user.php)**
- **Mô tả**: Xóa người dùng khỏi database
- **File liên quan**:
  - `admin/remove-user.php` - File chính
- **Các hành động**:
  - Nhấp Delete trên danh sách người dùng
  - Xóa record từ bảng `customer` WHERE customer_id
  - Chuyển hướng về danh sách người dùng

### 9. **Quản Lý Danh Mục (admin/catagory.php)**
- **Mô tả**: Hiển thị danh mục sản phẩm và số lượng sản phẩm
- **File liên quan**:
  - `admin/catagory.php` - File chính
- **Các hành động admin**:
  - Xem bảng danh mục:
    - S.No
    - Category (Tên danh mục)
    - No. of Posts (Số lượng sản phẩm trong danh mục)
  - Danh mục hỗ trợ: men, women, kids, electronics, home, sports, beauty, furniture, books, stationary, grocery, other
  - Có thể thêm/sửa/xóa danh mục (chưa hoàn toàn triển khai)

### 10. **Cài Đặt Website (admin/settings.php)**
- **Mô tả**: Quản lý cài đặt website
- **File liên quan**:
  - `admin/settings.php` - Form cài đặt
  - `admin/save-settings.php` - Lưu cài đặt
- **Các hành động admin**:
  - Chỉnh sửa những cài đặt:
    - Website Logo (upload ảnh logo)
    - Website Name (Tên website)
    - Footer Description (Mô tả footer)
  - Nhấp "Update" để lưu
  - Xem logo hiện tại
- **Lưu vào DB**: Bảng `settings`

---

## III. CÁC FILE XỬ LÝ (PROCESSING FILES)

### 1. **Quản Lý Giỏ Hàng (manage_cart.php)**
- **Mô tả**: Xử lý thêm sản phẩm vào giỏ hàng
- **Phương thức**: POST từ form trong viewdetail.php
- **Các hành động**:
  - Kiểm tra nếu sản phẩm đã tồn tại trong giỏ:
    - Nếu có → chuyển hướng về chi tiết sản phẩm
    - Nếu không → thêm sản phẩm mới vào giỏ
  - Lưu trữ: Session `$_SESSION['mycart']`
  - Dữ liệu lưu: name, price, product_id, category, product_qty, product_img
- **Trả về**: Chuyển hướng về viewdetail.php

### 2. **Thanh Toán (payment.php)**
- **Mô tả**: Xử lý thanh toán qua Stripe
- **Phương thức**: POST từ form checkout.php
- **Các hành động**:
  - Kiểm tra người dùng đã đăng nhập
  - Lấy thông tin giao hàng từ form
  - Tạo line items từ giỏ hàng
  - Gọi Stripe API: `\Stripe\Checkout\Session::create()`
  - Chuyển hướng người dùng đến trang thanh toán Stripe
- **Thông tin gửi đi**:
  - payment_method_types: ['card']
  - line_items: Danh sách sản phẩm (name, price, quantity)
  - mode: 'payment'
  - success_url: success.php?session_id=...
  - cancel_url: checkout.php
  - customer_email
  - metadata: Thông tin giao hàng (first_name, last_name, address, phone)

### 3. **Xác Nhận Thanh Toán (success.php)**
- **Mô tả**: Xác nhận thanh toán thành công từ Stripe
- **Các hành động**:
  1. Lấy `session_id` từ URL
  2. Truy vấn Stripe API để lấy chi tiết session
  3. Kiểm tra payment_status === 'paid'
  4. Nếu thanh toán thành công:
     - Tạo Order mới trong bảng `orders`
     - Tạo Order Items trong bảng `order_items`
     - Xóa SESSION giỏ hàng
     - Chuyển hướng về trang chủ với success message
  5. Nếu không:
     - Hiển thị lỗi "Payment Failed"
- **Dữ liệu lưu**:
  - **orders**: customer_id, total, address, phone, email, status, created_at
  - **order_items**: order_id, product_id, quantity, price

### 4. **Chi Tiết Đơn Hàng (order_details.php)**
- **Mô tả**: Hiển thị chi tiết một đơn hàng
- **Các hành động**:
  1. Kiểm tra người dùng đã đăng nhập
  2. Lấy `order_id` từ URL
  3. Xác minh đơn hàng thuộc về người dùng hiện tại
  4. Hiển thị thông tin đơn hàng:
     - Order ID
     - Total (Tổng tiền)
     - Status (Trạng thái)
     - Address (Địa chỉ)
     - Phone (Điện thoại)
     - Email
     - Date (Ngày tạo)
     - Items (Danh sách sản phẩm)

### 5. **Lưu Sản Phẩm Mới (admin/save-post.php)**
- **Mô tả**: Xử lý lưu sản phẩm mới từ form add-post.php
- **Các hành động**:
  1. Kiểm tra file upload
  2. Kiểm tra loại file (jpeg, jpg, png)
  3. Kiểm tra kích thước file (< 2MB)
  4. Di chuyển file vào thư mục `admin/upload/`
  5. Lấy thông tin sản phẩm từ form
  6. Tạo record mới trong bảng `products`
  7. Chuyển hướng về post.php

### 6. **Lưu Cài Đặt (admin/save-settings.php)**
- **Mô tả**: Xử lý lưu cài đặt website
- **Các hành động**:
  1. Kiểm tra file logo upload
  2. Nếu có file mới → kiểm tra và upload
  3. Nếu không → giữ file cũ
  4. Update bảng `settings` với:
     - website_name
     - website_logo
     - website_footer
  5. Chuyển hướng về settings.php

### 7. **Đăng Ký (includes/signup.inc.php)**
- **Mô tả**: Xử lý logic đăng ký người dùng
- **Các hành động**:
  1. Lấy dữ liệu từ form signup.php
  2. Kiểm tra validation qua `signupFn.inc.php`:
     - emptyInputSignup() - Kiểm tra trường trống
     - invalidPhone() - Kiểm tra số điện thoại
     - invalidEmail() - Kiểm tra email
     - pwdMatch() - Kiểm tra mật khẩu trùng
     - Email đã tồn tại?
  3. Nếu hợp lệ → Tạo user mới bằng createUser()
  4. Nếu không hợp lệ → Chuyển hướng về signup.php với error message

---

## IV. FILE CẤU HÌNH VÀ INCLUDE

### 1. **Database Config (includes/config.php)**
- **Mô tả**: Kết nối database MySQL
- **Nội dung**:
  - Server Name: localhost
  - Username: root
  - Password: (trống)
  - Database Name: db_ecommerce
- **Sử dụng**: MySQLi object-oriented

### 2. **Header Navigation (includes/headerNav.php)**
- **Mô tả**: Header chính của website
- **Các hành động**:
  - Khởi động session
  - Include config.php
  - Include functions.php
  - Lấy thông tin website từ settings
  - Hiển thị navigation bar

### 3. **Top Header Actions (includes/topheadactions.php)**
- **Mô tả**: Header trên cùng với search bar, giỏ hàng, account menu
- **Các hành động**:
  - Hiển thị logo website
  - Hiển thị search bar
  - Hiển thị số lượng giỏ hàng
  - Menu tài khoản (đăng nhập/đăng xuất)

### 4. **Desktop Navigation (includes/desktopnav.php)**
- **Mô tả**: Menu navigation cho desktop
- **Các hành động**:
  - Liên kết đến các trang chính
  - Danh mục sản phẩm
  - Liên kết về/liên hệ

### 5. **Mobile Navigation (includes/mobilenav.php)**
- **Mô tả**: Menu navigation cho mobile
- **Các hành động**:
  - Hiển thị menu khi screen nhỏ
  - Menu hamburger

### 6. **Category Sidebar (includes/categorysidebar.php)**
- **Mô tả**: Sidebar lọc danh mục sản phẩm
- **Các hành động**:
  - Hiển thị danh mục
  - Liên kết đến từng danh mục

### 7. **Footer (includes/footer.php)**
- **Mô tả**: Footer của website
- **Các hành động**:
  - Hiển thị thông tin công ty
  - Liên kết phổ biến
  - Thông tin liên hệ

### 8. **Signup Functions (includes/signupFn.inc.php)**
- **Mô tả**: Các hàm kiểm tra khi đăng ký
- **Các hàm**:
  - `emptyInputSignup()` - Kiểm tra trường trống
  - `invalidPhone()` - Kiểm tra số điện thoại
  - `invalidEmail()` - Kiểm tra email
  - `pwdMatch()` - Kiểm tra mật khẩu
  - `userExists()` - Kiểm tra email tồn tại
  - `createUser()` - Tạo user mới

---

## V. CÁC HÀM DATABASE (functions/functions.php)

### **Các Hàm Chính:**

1. **get_banner_details()** - Lấy banner từ bảng `banner`
2. **get_category_bar_products()** - Lấy danh mục bar từ `category_bar`
3. **get_categories()** - Lấy all categories từ `category`
4. **get_clothes_category()** - Lấy danh mục quần áo
5. **get_footwear_category()** - Lấy danh mục giày dép
6. **get_jewelry_category()** - Lấy danh mục trang sức
7. **get_perfume_category()** - Lấy danh mục nước hoa
8. **get_cosmetics_category()** - Lấy danh mục mỹ phẩm
9. **get_glasses_category()** - Lấy danh mục kính
10. **get_bags_category()** - Lấy danh mục túi xách
11. **get_best_sellers()** - Lấy sản phẩm bán chạy nhất
12. **get_new_arrivals()** - Lấy 8 sản phẩm mới nhất
13. **get_trending_products()** - Lấy 8 sản phẩm xu hướng
14. **get_top_rated_products()** - Lấy 8 sản phẩm được đánh giá cao
15. **get_deal_of_day()** - Lấy sản phẩm deal hôm nay
16. **get_product($id)** - Lấy chi tiết sản phẩm theo ID
17. **get_items_by_category_items($category)** - Lấy sản phẩm theo danh mục

---

## VI. BẢNG DATABASE CHÍNH

| Bảng | Cột | Mô Tả |
|------|-----|-------|
| **customer** | customer_id, customer_fname, customer_email, customer_phone, customer_address, customer_pwd, customer_role | Thông tin khách hàng |
| **products** | product_id, product_title, product_price, discounted_price, product_desc, product_catag, product_date, product_img, product_left, product_author, status | Sản phẩm |
| **orders** | id, customer_id, total, address, phone, email, status, created_at | Đơn hàng |
| **order_items** | id, order_id, product_id, quantity, price | Chi tiết đơn hàng |
| **settings** | website_name, website_logo, website_footer | Cài đặt website |
| **banner** | banner_id, banner_title, banner_subtitle, banner_image, banner_items_price, banner_status | Banner carousel |
| **category_bar** | category_bar_id, category_name, category_image, category_status | Danh mục bar |
| **deal_of_the_day** | id, product_id, deal_status | Sản phẩm deal hôm nay |

---

## VII. LUỒNG HOẠT ĐỘNG CHÍNH

### **Luồng Mua Hàng (Checkout Flow):**
1. Người dùng duyệt sản phẩm → index.php, category.php, search.php
2. Xem chi tiết sản phẩm → viewdetail.php
3. Thêm vào giỏ → manage_cart.php (Session `mycart`)
4. Xem giỏ hàng → cart.php
5. Thanh toán → checkout.php (form thông tin giao hàng)
6. Xử lý thanh toán → payment.php (gọi Stripe API)
7. Stripe xử lý → Chuyển hướng về success.php
8. Xác nhận → success.php (tạo order, lưu order_items)
9. Hiển thị thành công → index.php?order_success=1

### **Luồng Admin Quản Lý Sản Phẩm:**
1. Admin đăng nhập → admin/login.php
2. Xem danh sách sản phẩm → admin/post.php
3. Thêm sản phẩm → admin/add-post.php → admin/save-post.php
4. Chỉnh sửa sản phẩm → admin/update-post.php
5. Xóa sản phẩm → admin/remove-post.php

### **Luồng Đăng Ký Người Dùng:**
1. Người dùng vào trang signup → signup.php
2. Nhập thông tin và submit → includes/signup.inc.php
3. Kiểm tra validation → includes/signupFn.inc.php
4. Nếu hợp lệ → Tạo user mới trong bảng `customer`
5. Chuyển hướng → login.php hoặc hiển thị error

---

## VIII. TÍNH NĂNG & CÔNG NGHỆ

### **Tính Năng Chính:**
✅ Đăng ký/Đăng nhập  
✅ Duyệt sản phẩm  
✅ Tìm kiếm sản phẩm  
✅ Giỏ hàng  
✅ Thanh toán (Stripe)  
✅ Quản lý hồ sơ  
✅ Quản lý sản phẩm (Admin)  
✅ Quản lý người dùng (Admin)  
✅ Cài đặt website (Admin)  
✅ Pagination  
✅ Image magnifier  
✅ Responsive design  

### **Công Nghệ Sử Dụng:**
- **Backend**: PHP (MySQLi Object-Oriented)
- **Frontend**: HTML, CSS, Bootstrap, JavaScript, jQuery
- **Database**: MySQL
- **Payment**: Stripe API
- **Session Management**: PHP Session
- **File Upload**: PHP $_FILES
- **Security**: real_escape_string() (basic SQL injection prevention)

---

## IX. SECURITY NOTES (Lưu Ý Bảo Mật)

⚠️ **Các vấn đề bảo mật cần cải thiện:**
1. Mật khẩu lưu dưới dạng plain text (không mã hóa - **RẤT NGUY HIỂM**)
2. Dùng `real_escape_string()` chứ không dùng Prepared Statements (SQL injection risk)
3. Không có CSRF token
4. Không validate input tốt trên server-side
5. Không có rate limiting
6. Không có logging & monitoring
7. Stripe API key hardcoded trong file source code
8. Không có HTTPS enforcement
9. Session timeout không được thiết lập

**Khuyến nghị:**
- Sử dụng bcrypt hoặc password_hash() để mã hóa mật khẩu
- Chuyển sang Prepared Statements với BindParam
- Thêm CSRF token
- Thêm input validation tốt hơn
- Sử dụng environment variables cho API keys
- Thêm logging & monitoring
- Implement rate limiting
- Bắt buộc HTTPS
- Thiết lập session timeout

