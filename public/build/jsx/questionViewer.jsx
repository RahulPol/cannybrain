
var QuestionFilter = React.createClass({

    onApplyFilterClicked: function () {
        this.props.filterChanged(this.refs.answerTypeSelect.value, this.refs.categorySelect.value)
    },

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
                    $('#questionFilterOverlay').css('display', 'block');
                },
                success: function (resp) {
                    var categoriesDetails = resp;
                    resp.unshift({
                        id: 'all',
                        name: 'All'
                    })

                    var answerType = [{
                        id: 'all',
                        value: 'All'
                    }, {
                        id: 'MCQ',
                        value: 'MCQ'
                    }, {
                        id: 'True/False',
                        value: 'True False'
                    }]

                    //retrieve categories in categoriesDetails array
                    if (resp.length > 0) {
                        resp.forEach(function (category) {
                            $("#categorySelect").append("<option value=" + category.id + ">" + category.name + "</option>")
                        })

                        answerType.forEach(function (type) {
                            $('#answerTypeSelect').append("<option value=" + type.id + ">" + type.value + "</option>")
                        })
                    }

                    //Create category seclect 2
                    $(_this.refs.categorySelect).select2();

                    $(_this.refs.answerTypeSelect).select2();

                    // //use following for resetting select2
                    // $("#categorySelect").val('').trigger('change');
                    // $("#answerTypeSelect").val('').trigger('change');

                    $('#questionFilterOverlay').css('display', 'none');
                },
                error: function (err) {
                    $('#questionFilterOverlay').css('display', 'none');
                }
            });
        }.bind(this);
        getAllCategories();
    },//componentDidMount

    render: function () {
        return (
            <div className="question-filter-content col-md-12">
                <div className='box question-filter-box'>
                    <div className='box-header with-border'>
                        <h2 className='box-title'>Filter</h2>
                    </div>
                    <div className="box-body">
                        <select ref="answerTypeSelect" id="answerTypeSelect" className="form-control select2 col-md-12" style={{ width: 30 + '%', marginRight: 10 + 'px' }} >
                        </select>
                        <span style={{ marginRight: 15 + 'px' }}></span>
                        <select ref="categorySelect" id="categorySelect" className="form-control select2 col-md-12" style={{ width: 30 + '%' }} >
                        </select>
                        <span style={{ marginRight: 10 + 'px' }}></span>
                        <button ref="applyFilter" onClick={this.onApplyFilterClicked} className="btn btn-default btn-filter" title="Apply Filter" >
                            <i className="fa fa-filter fa-lg"></i>
                        </button>
                    </div>
                    <div id="questionFilterOverlay" className="overlay" style={{ display: 'none' }} >
                        <i className="fa fa-spinner fa-pulse fa-fw"></i>
                    </div>
                </div>
            </div>
        )
    }//render
});

var QuestionContainer = React.createClass({

    isCorrectAnswer: function (option) {
        var answer = this.props.question.answer;
        return answer.indexOf(option) != -1 ? true : false;
    },//isCorrectAnswer

    getMarks: function (marks) {
        return numeral(marks, "0[.]0");
    },//getMarks

    onEditQuestionClicked: function (questionId, answerType) {
        console.log('question id..', questionId, answerType);
        var editQuestionUrl = window.location.origin + "/a/configuration/questionbank/" + answerType + "?action=edit&questionid=" + questionId;
        window.location.href = editQuestionUrl;

    },//onEditQuestionClicked

    render: function () {
        return (
            <div className="col-md-12">
                <div className='box question-container-box question-container-box collapsed-box'>
                    <div className='box-header with-border'>
                        <h2 className='box-title' style={{ fontWeight: "bold" }}>
                            {this.props.question.title}
                        </h2>
                        <div className="box-tools pull-right">
                            <ul className="breadcrumb">

                                <li>{this.props.question.category.name}</li>
                                <li>{this.props.question.chapter.name}</li>
                                <li>{this.props.question.answer_type}</li>
                            </ul>

                            <button className="btn btn-box-tool" data-widget="collapse"><i className="fa fa-plus"></i></button>
                            <button className="btn btn-box-tool" title="edit" onClick={() => this.onEditQuestionClicked(this.props.question.id, this.props.question.answer_type)} >
                                <i className="fa fa-pencil"></i>
                            </button>
                            <button className="btn btn-box-tool" style={{ color: 'red' }} title='delete'><i className="fa fa-trash"></i></button>
                        </div>
                    </div>
                    <div className="box-body">
                        <div style={{ display: this.props.question.optionA != '' ? 'block' : 'none' }}>
                            <h3>
                                <span className="is-correct-option" style={{ display: this.isCorrectAnswer('optionA') ? 'inline-block' : 'none', color: "lightgreen" }}>
                                    <i className="fa fa-check"></i>
                                </span>
                                A.
                            </h3>
                            <div dangerouslySetInnerHTML={{ __html: this.props.question.optionA }}>
                            </div>
                        </div>
                        <div style={{ display: this.props.question.optionB != '' ? 'block' : 'none' }}>
                            <h3>
                                <span className="is-correct-option" style={{ display: this.isCorrectAnswer('optionB') ? 'inline-block' : 'none', color: "lightgreen" }}>
                                    <i className="fa fa-check"></i>
                                </span>
                                B.
                            </h3>
                            <div dangerouslySetInnerHTML={{ __html: this.props.question.optionB }}>
                            </div>
                        </div>
                        <div style={{ display: this.props.question.optionC != '' ? 'block' : 'none' }}>
                            <h3>
                                <span className="is-correct-option" style={{ display: this.isCorrectAnswer('optionC') ? 'inline-block' : 'none', color: "lightgreen" }}>
                                    <i className="fa fa-check"></i>
                                </span>
                                C.
                            </h3>
                            <div dangerouslySetInnerHTML={{ __html: this.props.question.optionC }}>
                            </div>
                        </div>
                        <div style={{ display: this.props.question.optionD != '' ? 'block' : 'none' }}>
                            <h3>
                                <span className="is-correct-option" style={{ display: this.isCorrectAnswer('optionD') ? 'inline-block' : 'none', color: "lightgreen" }}>
                                    <i className="fa fa-check"></i>
                                </span>
                                D.
                            </h3>
                            <div dangerouslySetInnerHTML={{ __html: this.props.question.optionD }}>
                            </div>
                        </div>
                        <div style={{ display: this.props.question.optionE != '' ? 'block' : 'none' }}>
                            <h3>
                                <span className="is-correct-option" style={{ display: this.isCorrectAnswer('optionE') ? 'inline-block' : 'none', color: "lightgreen" }}>
                                    <i className="fa fa-check"></i>
                                </span>
                                E.
                            </h3>
                            <div dangerouslySetInnerHTML={{ __html: this.props.question.optionE }}>
                            </div>
                        </div>
                        <div style={{ display: this.props.question.optionF != '' ? 'block' : 'none' }}>
                            <h3>
                                <span className="is-correct-option" style={{ display: this.isCorrectAnswer('optionF') ? 'inline-block' : 'none', color: "lightgreen" }}>
                                    <i className="fa fa-check"></i>
                                </span>
                                F.
                            </h3>
                        </div>
                        <div dangerouslySetInnerHTML={{ __html: this.props.question.optionF }}>
                        </div>
                    </div>
                </div>
            </div>
        );
    }

});

var QuestionList = React.createClass({
    getInitialState: function () {
        var questionDetails = [];
        return {
            questionDetails: questionDetails
        }
    },//getInitialState

    componentDidMount: function () {
        this.getQuestionDetails('all', 'all');
    },//componentDidMount

    getQuestionDetails: function (answerType, categoryId) {

        var url = "/a/configuration/questionbank/getAllQuestions?answerType=" + answerType + "&category=" + categoryId,
            type = "Get",
            dataType = "json";

        $.ajax({
            type: type,
            url: url,
            dataType: dataType,
            beforeSend: function () {
                $('#questionViewerOverlay').css('display', 'block');
            },
            success: function (resp) {
                $('#questionViewerOverlay').css('display', 'none');
                console.log('question details...', resp);

                //retrieve Questions in QuestionsDetails array
                $('#questionCount').html(resp.length);

                this.setState({
                    questionDetails: resp
                });

                // if (resp.length > 0) {

                // } else {
                //     // TODO: Add No Data Available Watermark 
                // }
                $('#questionViewerOverlay').css('display', 'none');
            }.bind(this),
            error: function (err) {
                $('#questionViewerOverlay').css('display', 'none');
                console.log('error....', err);
            }
        });

    },//getQuestionDetails

    eachQuestion: function (question, i) {
        return (
            <QuestionContainer key={i} index={i} question={question} questionId={question.id}></QuestionContainer>
        );
    },//eachQuestion

    render: function () {
        return (
            <div className="question-list col-md-12">
                <div className='box question-details-box'>
                    <div className='box-header with-border'>
                        <h2 className='box-title'>Questions</h2>
                    </div>
                    <div className="box-body">
                        {this.state.questionDetails.map(this.eachQuestion)}
                    </div>

                    <div id="questionViewerOverlay" className="overlay" style={{ display: 'none' }} >
                        <i className="fa fa-spinner fa-pulse fa-fw"></i>
                    </div>
                </div>
            </div>
        );
    }
});

window.QuestionViewer = React.createClass({

    questionFilterChanged: function (answerType, category) {
        //this.updateQuestionFilter(answerType, category);
        this.refs.questionList.getQuestionDetails(answerType, category);
        console.log('question list...', this);
    },//questionFilterChanged    


    updateChapter: function (answerType, category, chapter) {

        //this.refs.questionList.initializeChapter(questionFilter);
    },//updateChapter

    render: function () {
        return (
            <div className="question-viewer row">
                <div className='question-filter row'>
                    <QuestionFilter ref="questionFilter" filterChanged={this.questionFilterChanged}></QuestionFilter>
                </div>

                <div className='question-list row'>
                    <QuestionList ref="questionList" filterChanged={this.questionFilterChanged}></QuestionList>
                </div>

            </div>
        );
    }//render
});