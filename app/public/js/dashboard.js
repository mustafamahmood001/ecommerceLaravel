// Ajax for brand
$('#search').on('keyup', function() {
    var value = $(this).val();
    $.ajax({
        type: 'get',
        url: "/admin/brands",
        data: { 'search': value },
        success: function(data) {
            console.log(data);
            var brands = data.brands;
            var html = '';

            if (brands.data.length > 0) { // Make sure to access the paginated data
                $.each(brands.data, function(i, brand) {
                    html += '<tr>\
                        <td>' + brand.id + '</td>\
                        <td>' + brand.name + '</td>\
                        <td>' + brand.description + '</td>\
                        <td>' + brand.is_active + '</td>\
                        <td>\
                            <div style="width: 100px; height: 100px;">\
                                <img src="' + window.location.origin + '/storage/' + brand.photo + '" alt="Brand Photo" class="img-fluid rounded-circle search-result-image" id="insertedImages">\
                            </div>\
                        </td>\
                        <td>' +
                        '<button class="btn btn-outline-success active-brand" data-brand-id="' + brand.id + '"><a href="/admin/brandactive/' + brand.id + '">Active/Deactive</a></button>' +
                        '</td>\
                        <td>' +
                        '<button class="btn btn-warning"><a href="/admin/brands/' + brand.id + '/edit">Edit</a></button>' +
                        // Include the form for delete button
                         '<button class="btn btn-danger delete-brand" data-brand-id="' + brand.id + '"><a href="/admin/delete/' + brand.id + '">Delete</a></button>';
                        '</td>\
                    </tr>';
                });

                // Replace the table content including pagination links
                $('#allData').html(html);
            } else {
                html += '<tr>\
                    <td colspan="3">No brand Found</td>\
                </tr>';
                $('#allData').html(html);
            }
        }
    });
});

// Ajax for product
$('#searchProduct').on('keyup', function () {
    var value = $(this).val();
    $.ajax({
        type: 'get',
        url: "/admin/products",
        data: { 'searchProduct': value },
        success: function (data) {
            console.log(data);
            var products = data.products;
            var html = '';

            if (products.data.length > 0) {
                $.each(products.data, function (i, product) {
                    html += '<tr>\
                        <td>' + product.name + '</td>\
                        <td>' + product.price + '</td>\
                        <td>' + product.sale_price + '</td>\
                        <td>' + product.color + '</td>\
                        <td>' + product.brand + '</td>\
                        <td>' + product.product_code + '</td>\
                        <td>' + product.function + '</td>\
                        <td>' + product.stock + '</td>\
                        <td>' + product.description + '</td>\
                        <td>\
                            <div style="width: 100px; height: 100px;">\
                                <img src="' + window.location.origin + '/storage/' + product.image + '" alt="Product Photo" class="img-fluid rounded-circle search-result-image" id="insertedImages">\
                            </div>\
                        </td>\
                        <td>' + product.is_active + '</td>\
                        <td>' +
                        '<button class="btn btn-outline-success active-user" data-product-id="' + product.id + '"><a href="/admin/productactive/' + product.id + '">Active/Deactive</a></button>' +
                        '</td>\
                        <td>' +
                        '<button class="btn btn-warning"><a href="/admin/products/' + product.id + '/edit">Edit</a></button>' +
                        '<button class="btn btn-danger delete-user" data-user-id="' + product.id + '"><a href="/admin/deleteproduct/' + product.id + '">Delete</a></button>' +
                        '</td>\
                    </tr>';
                });

                // Replace the table content including pagination links
                $('#productAllData').html(html);
            } else {
                html += '<tr>\
                    <td colspan="11">No product Found</td>\
                </tr>';
                $('#productAllData').html(html);
            }
        }
    });
});

// Ajax for userlist

$('#searchUser').on('keyup', function () {
    var value = $(this).val();
    $.ajax({
        type: 'get',
        url: "/admin/userdetails",
        data: { 'searchUser': value }, // Use 'searchUser' instead of 'search'
        success: function (data) {
            console.log(data);
            var users = data.user; // Use 'user' instead of 'users'
            var html = '';

            if (users.data.length > 0) { // Make sure to access the paginated data
                $.each(users.data, function (i, user) {
                    html += '<tr>\
                        <td>' + user.id + '</td>\
                        <td>' + user.fname + '</td>\
                        <td>' + user.lname + '</td>\
                        <td>' + user.email + '</td>\
                        <td>' + user.role + '</td>\
                        <td>' + user.country + '</td>\
                        <td>' + user.city + '</td>\
                        <td>' + user.gender + '</td>\
                        <td>\
                            <div style="width: 100px; height: 100px;">\
                                <img src="' + window.location.origin + '/storage/' + user.photo + '" alt="User Photo" class="img-fluid rounded-circle search-result-image" id="insertedImages">\
                            </div>\
                        </td>\
                        <td>' +
                        '<button class="btn btn-outline-success active-user" data-user-id="' + user.id + '"><a href="/admin/userprofileactive/' + user.id + '">Active/Deactive</a></button>' +
                        '</td>\
                        <td>' +
                        '<button class="btn btn-warning"><a href="/admin/userdetailsedit' + user.id + '">Edit</a></button>' +
                        '<button class="btn btn-danger delete-user" data-user-id="' + user.id + '"><a href="/admin/userprofiledelete/' + user.id + '">Delete</a></button>' +
                        '</td>\
                    </tr>';
                });

                // Replace the table content including pagination links
                $('#userAllData').html(html);
            } else {
                html += '<tr>\
                    <td colspan="11">No user Found</td>\
                </tr>';
                $('#userAllData').html(html);
            }
        }
    });
});




// Session Message out
$(document).ready(function() {
    // Set a timeout to remove the alert after 5 seconds
    setTimeout(function() {
        $('#alertMessage').fadeOut('slow', function() {
            // Remove the element after fade-out
            $(this).remove();
        });
    }, 5000);
});

// Alert for delete
function alertDelete(){
    alert("Are u sure want to delete");
}
