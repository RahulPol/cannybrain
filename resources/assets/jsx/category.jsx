window.Category = React.createClass({
    change: function () {
        if (this.refs.categorySelect.value != '' && this.refs.categorySelect.value != null) {
            this.props.categoryChanged(this.refs.categorySelect.value);
        }
    },//change

    componentDidMount: function () {
        var getAllCategories = function () {

            var _this = this;

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
                    categoriesDetails = resp;
                    //retrieve categories in categoriesDetails array
                    if (resp.length > 0) {
                        resp.forEach(function (category) {
                            $("#categorySelect").append("<option value=" + category.id + ">" + category.name + "</option>")
                        })
                    }

                    //Create category seclect 2
                    $(_this.refs.categorySelect).select2({
                        placeholder: "Select Category"
                    })
                        .on('change', function () {
                            _this.change();
                        });

                    //use following for resetting select2
                    $("#categorySelect").val('').trigger('change');
                    $('#categoryOverlay').css('display', 'none');
                },
                error: function (err) {
                    $('#categoryOverlay').css('display', 'none');
                }
            });
        }.bind(this);
        getAllCategories();
    },//componentDidMount

    render: function () {
        console.log('this..', this);
        return (
            <div className='box category-box'>
                <div className='box-header with-border'>
                    <h3 className='box-title'>Select Category</h3>
                </div>
                <div className="box-body">
                    <select ref="categorySelect" id="categorySelect" className="form-control select2 col-md-12" style={{ width: 100 + '%' }}>
                    </select>
                </div>
                <div id="categoryOverlay" className="overlay" style={{ display: 'none' }} >
                    <i className="fa fa-spinner fa-pulse fa-fw"></i>
                </div>
            </div>
        )
    },//render
});
