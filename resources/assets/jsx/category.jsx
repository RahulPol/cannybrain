window.Category = React.createClass({
    componentDidMount: function () {
        var getAllCategories = function () {

            var getAllCategoriesUrl = "/a/configuration/categories/getCategoriesDropdown",
                type = "Get",
                dataType = "json",
                categoriesDetails = [];

            $.ajax({
                type: type,
                url: getAllCategoriesUrl,
                dataType: dataType,
                beforeSend: function () {
                    $('#categoryOverlay').css('display', 'block');
                },
                success: function (resp) {
                    console.log('category details...', resp);
                    categoriesDetails = resp;
                    //retrieve categories in categoriesDetails array
                    if (resp.length > 0) {
                        resp.forEach(function (category) {
                            $("#categorySelect").append("<option value=" + category.id + ">" + category.name + "</option>")
                        })
                    }

                    //Create category seclect 2
                    $("#categorySelect").select2({
                        placeholder: "Select Category"
                    })
                        .on('change', function (e) {
                            console.log('changed value');
                            self.change(e);
                        });

                    //use following for resetting select2
                    $("#categorySelect").val('').trigger('change');


                    $('#categoryOverlay').css('display', 'none');
                },
                error: function (err) {
                    $('#categoryOverlay').css('display', 'none');

                    console.log('error in fetching category..', err);
                }
            });
        };

        getAllCategories();
    },//componentDidMount

    change: function (event) {
        console.log('category change', event);
    },//change

    render: function () {
        return (
            <div className='box box-solid category-box'>
                <div className='box-header with-border'>
                    <h3 className='box-title'>Select Category</h3>
                </div>
                <div className="box-body">
                    <select ref="categorySelect" id="categorySelect" className="form-control select2 col-md-12" onChange={this.change} >
                    </select>
                </div>
                <div id="categoryOverlay" className="overlay" style={{ display: 'none' }} >
                    <i className="fa fa-spinner fa-pulse fa-fw"></i>
                </div>
            </div>
        )
    },//render
});
