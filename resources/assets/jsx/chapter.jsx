window.Chapter = React.createClass({
    componentDidMount: function () {
        // var getChapterForCategory = function () {

        //     var getAllCategoriesUrl = "/a/configuration/categories/getCategoriesDropdown",
        //         type = "Get",
        //         dataType = "json",
        //         categoriesDetails = [];

        //     $.ajax({
        //         type: type,
        //         url: getAllCategoriesUrl,
        //         dataType: dataType,
        //         beforeSend: function () {
        //             $('#categoryOverlay').css('display', 'block');
        //         },
        //         success: function (resp) {
        //             console.log('category details...', resp);
        //             categoriesDetails = resp;
        //             //retrieve categories in categoriesDetails array
        //             if (resp.length > 0) {
        //                 resp.forEach(function (category) {
        //                     $("#categorySelect").append("<option value=" + category.id + ">" + category.name + "</option>")
        //                 })
        //             }

        //             //Create category seclect 2
        //             $("#categorySelect").select2({
        //                 placeholder: "Select Category"
        //             });

        //             //use following for resetting select2
        //             $("#categorySelect").val('').trigger('change');


        //             $('#categoryOverlay').css('display', 'none');
        //         },
        //         error: function (err) {
        //             $('#categoryOverlay').css('display', 'none');

        //             console.log('error in fetching category..', err);
        //         }
        //     });
        // };

        // getAllCategories();
    },//componentDidMount

    render: function () {
        return (
            <div className='box box-solid chapter-box'>
                <div className='box-header with-border'>
                    <h3 className='box-title'>Select Chapter</h3>
                </div>
                <div className="box-body">
                </div>
            </div>
        )
    }
});
