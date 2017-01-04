window.Chapter = React.createClass({
    getInitialState: function () {
        return {
            categoryId: ''
        }
    },//getInitialState

    componentDidUpdate: function () {
        //this is called when category component value is changed, so now we need to update chapters data.
        if (this.state.categoryId == '') {
            $(this.refs.chapterSelect).select2({
                placeholder: "Select Chapter"
            })
        } else {
            var getAllChaptersForCategory = function () {

                var _this = this;

                var getAllChaptersForCategoryUrl = "/a/configuration/chapters/getChaptersDropdownForCategory/" + this.state.categoryId,
                    type = "Get",
                    dataType = "json",
                    chapterDetails = [];

                $("#chapterSelect").html('');

                $.ajax({
                    type: type,
                    url: getAllChaptersForCategoryUrl,
                    dataType: dataType,
                    beforeSend: function () {
                        $('#chapterOverlay').css('display', 'block');
                    },
                    success: function (resp) {
                        chapterDetails = resp;
                        //retrieve categories in chapterDetails array
                        if (resp.length > 0) {
                            resp.forEach(function (category) {
                                $("#chapterSelect").append("<option value=" + category.id + ">" + category.name + "</option>")
                            })
                        }

                        if (_this.props.defaultValue == '') {
                            //Create category seclect 2
                            $(_this.refs.chapterSelect).select2({
                                placeholder: "Select Chapter"
                            })

                            //use following for resetting select2
                            $("#chapterSelect").val('').trigger('change');
                        } else {
                            $("#chapterSelect").val(_this.props.defaultValue).trigger('change');
                        }

                        $('#chapterOverlay').css('display', 'none');
                    },
                    error: function (err) {
                        $('#chapterOverlay').css('display', 'none');
                    }
                });
            }.bind(this);
            getAllChaptersForCategory();
        }
    },//componentDidUpdate

    componentDidMount: function () {
        $(this.refs.chapterSelect).select2({
            placeholder: "Select Chapter"
        })
    },//componentDidMount

    // componentWillUpdate: function (prevProps, nextProps) {
    //     console.log('will update...', prevProps, nextProps);
    // },//componentWillUpdate

    // componentWillReceiveProps: function (nextProps) {
    //     console.log('next props in chapter...', nextProps);
    //     $("#chapterSelect").select2('val', nextProps.defaultValue.toString());
    // },//componentWillReceiveProps

    initializeChapter: function (categoryId) {
        this.setState({ categoryId: categoryId });
    },//initializeChapter


    render: function () {
        console.log('render called');
        return (
            <div className='box chapter-box'>
                <div className='box-header with-border'>
                    <h3 className='box-title'>Select Chapter</h3>
                </div>
                <div className="box-body">
                    <select ref="chapterSelect" id="chapterSelect" className="form-control select2 col-md-12" style={{ width: 100 + '%' }} >
                    </select>
                </div>
                <div id="chapterOverlay" className="overlay" style={{ display: 'none' }} >
                    <i className="fa fa-spinner fa-pulse fa-fw"></i>
                </div>
            </div>
        )
    },//render
});
