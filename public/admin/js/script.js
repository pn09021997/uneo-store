
    $(document).ready(function () {
        const urlAllProducts = "../ajax/getAllProducts.php";
        const allProducts = [];

        $.ajax({
            type: 'GET',
            url: urlAllProducts,
            dataType: 'JSON',
            success: function (data) {
                for (let i = 0; i < data.length; i += 1) {
                    allProducts.push(data[i]);
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });

        // --- SEARCH
        if ($('#searchInput')) {
            $('#searchInput').keyup((e) => {
                const value = e.target.value.toLowerCase();
                let products = [];
                if (value.length > 0)
                    products = allProducts.filter(
                        (o) => o.name.toLowerCase().indexOf(value) !== -1
                    );
                renderSearchList(products, value);
            });

            function renderSearchList(products, search) {
                let renderList = '';
                for (let i = 0; i < products.length; i++) {
                    const element = products[i];
                    const img = products[i].pro_image;
                    const name = products[i].name;
                    renderList += `
                    <li style='display: flex; margin-bottom: 5px'>
                    <img src="${img}" alt="logo-img" class="img-fluid" width='50px' style='margin-right: 5px'>
                    <a href="?keyword=${name}" class="list-group-item list-group-item-action">
                    ${name}
                    </a>    
                    </li>`;
                }
                $('#searchList').empty();
                $('#searchList').append(renderList);
            }
        }

            //Render Products By Category                                                                                                                                                                
        if ($('.list-category-item')) {
            const urlListProducts = "../ajax/getProductByCategory.php";
            $('.list-category-item').each(function (key, val) {
                $(this).click(() => {
                    $.ajax({
                        type: 'POST',
                        url: urlListProducts,
                        data: { categoryID: val.getAttribute('id')},
                        dataType: 'JSON',
                        success: function (data) {
                            let products = [];
                            data.forEach(element => {
                                products.push(element);
                            });
                            renderProductsByCategory(products);
                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                        }
                    });
                });
            })
        
            function renderProductsByCategory(products) {
                let renderList = '';
                $('#totalResult').html('<b>There are ' + products.length + ' results.</b>');
                $('#paginate').html('');
                for (let i = 0; i < products.length; i++) {
                    let txt = products[i].created_at;
                    let createdDay = new Date(txt).toDateString().substring(3, txt.length);
                    renderList += `
                    <tr>
                    <td width=250>
                        <img src=${products[i].pro_image} alt="" class='img-fluid'>
                    </td>
                    <td>
                        <h5>${products[i].name}</h5>
                    </td>
                    <td class='mobile-hidden'>
                        <p>${products[i].description.substring(0, 100) + ' ...'}</p>
                    </td>
                    <td>
                        <h5>${'$' + products[i].price}</h5>
                    </td>
                    <td> <h5>${products[i].vote}</h5></td>
                    <td> <h5>${products[i].receipt}</h5></td>
                    <td> <h5>${createdDay}</h5></td>
                    <td>
                        <a href="form_update.php?functionType=products&id=${products[i].id}" class="btn btn-success btn-mini" style='margin-bottom: 5px'>Edit</a>
                        <a href="delete_product.php?id=${products[i].id}" class="btn btn-danger btn-mini" style='margin-bottom: 5px'>Delete</a>
                    </td></tr>`;
                }
                $('.productsList').empty();
                $('.productsList').append(renderList);
            } 
        }
    });