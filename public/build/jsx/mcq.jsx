
var Option = React.createClass({

    getInitialState: function () {
        return { selected: false }
    },

    onTickClicked: function () {
        this.setState({ selected: !this.state.selected });
    },//onTickClicked

    componentDidUpdate: function () {
        CKEDITOR.instances[this.props.optionId].setData(CKEDITOR.instances[this.props.optionId].getData());
    },

    componentDidMount: function () {
        CKEDITOR.replace(this.props.optionId);
    },//componentDidMount


    remove: function () {
        this.props.removeOption(this.props.index);
    },//remove    

    render: function () {
        var optionButtonClass = "btn btn-sm btn-default btn-flat";
        if (this.state.selected == true) {
            optionButtonClass = "btn btn-sm btn-success btn-flat";
        } else {
            optionButtonClass = "btn btn-sm btn-default btn-flat";
        }

        return (
            <div className="option-body col-md-6">
                <div className="option-body-header">
                    <span className="option-body-title">({this.props.optionText})</span>
                    <span className="pull-right">
                        <button className={optionButtonClass} onClick={this.onTickClicked}>
                            <i className="fa fa-check" style={{ paddingRight: 10 + 'px' }}></i>mark this option as answer.
                        </button>
                        <button className="btn btn-sm btn-danger btn-flat" onClick={this.remove} style={{ marginLeft: 10 + 'px' }}><i className="fa fa-trash"></i></button>
                    </span>
                </div>
                <div className="option-body-text">
                    <textarea id={this.props.optionId} ref={this.props.optionId} defaultValue={this.props.optionValue} rows="5" cols="50">
                    </textarea>
                </div>
            </div>
        );
    }//render
});

var OptionSet = React.createClass({

    getInitialState: function () {
        var options = [];
        if (this.props.action == 'edit') {
            //get data for options from database
            options.push({
                text: 'A',
                body: '<b>Test this, option from db!</b>'
            })
        }

        return {
            optionText: ['A', 'B', 'C', 'D', 'E', 'F'],
            options: options
        }
    },

    eachOption: function (option, i) {
        var optionId = "option" + option.text;
        return (
            <Option key={i} index={i} ref={optionId} optionText={option.text} optionValue={option.body} optionId={optionId} questionId={this.props.questionId}
                action={this.props.action} removeOption={this.remove}></Option>
        );
    },//eachOption

    add: function () {
        var arr = this.state.options;
        var optionCount = arr.length;
        for (var i = 0; i < optionCount; i++) {
            arr[i].body = CKEDITOR.instances['option' + arr[i].text.toString()].getData();
        }

        if (optionCount < 6) {
            arr.push({
                text: this.state.optionText[optionCount],
                body: ''
            });

            this.setState({ options: arr });
        } else {
            alert('enough options');
        }
    },//add

    remove: function (position) {

        var arr = this.state.options;
        this.setState({ options: [] })

        var result = [];
        var shiftFlag = false;
        for (var i = 0, l = arr.length - 1; i < l; i++) {
            var option = arr[i];
            if (i == position) {
                shiftFlag = true;
            }

            if (shiftFlag) {
                CKEDITOR.instances['option' + arr[i].text.toString()].setData(CKEDITOR.instances['option' + arr[i + 1].text.toString()].getData())
                this.refs['option' + arr[i].text.toString()].state = this.refs['option' + arr[i + 1].text.toString()].state;
            } else {
                CKEDITOR.instances['option' + arr[i].text.toString()].setData(CKEDITOR.instances['option' + arr[i].text.toString()].getData())
            }
            result.push(option);
        }

        this.setState({ options: result });

    },//remove

    render: function () {

        var isAddDisabled = false;
        if (this.state.options.length >= 6) {
            isAddDisabled = true;
        }

        return (
            <div className="option-set">
                <div className="option-set-header">
                    <span className="option-set-title" > Options </span>
                    <span className="pull-right">
                        <button className="btn btn-primary btn-flat" onClick={this.add} disabled={isAddDisabled} ><i className="fa fa-plus"></i> Add option</button>
                    </span>
                </div>
                <div className="option-content">
                    {this.state.options.map(this.eachOption)}
                </div>
            </div>
        );
    }//render
});

var Question = React.createClass({

    componentDidMount: function () {
        CKEDITOR.replace(this.props.questionId);
        if (this.props.action == "create") {
            //
        }
        else if (this.props.action == "edit") {
            //get question body data from ajax and update CKEDITOR
            var data = "<b>Test this question from db!</b>";
            CKEDITOR.instances[this.props.questionId].setData(data);
        }
    },//componentDidMount

    render: function () {
        return (
            <div className="question-content col-md-12">
                <span className="question-title">Question</span>
                <div className="question-header">
                    <input ref="questionHeader" type="text" className="form-control" placeholder="* Question Header" ></input>
                </div>
                <div className="question-body">
                    <textarea ref={this.props.questionId} id={this.props.questionId} rows="5" cols="50">
                    </textarea>
                </div>
                <div className="question-footer">
                    <input ref="questionFooter" type="text" className="form-control" placeholder="Example: Select three options" ></input>
                </div>
            </div>
        );
    }//render

});


window.Board = React.createClass({


    retrieveQuestionDetails: function () {
        var errorList = [];
        var question = this.refs.question;
        var questionId = question.props.questionId;
        var questionHeader = question.refs.questionHeader.value;
        var questionBody = CKEDITOR.instances[question.props.questionId].getData();
        var questionFooter = question.refs.questionFooter.value;

        if (questionHeader == '' || questionHeader == undefined || questionHeader == null) {
            errorList.push('Question Header can not be empty.');
        }

        // if (questionBody == '' || questionBody == undefined || questionBody == null) {
        //     errorList.push('Question Body can not be empty.');
        // }

        if (errorList.length > 0) {
            return {
                errorFlag: true,
                errorList: errorList
            };
        } else {
            return {
                errorFlag: false,
                errorList: errorList,
                questionId: questionId,
                title: questionHeader,
                body: questionBody,
                footer: questionFooter
            }
        }
    },//retrieveQuestionDetails

    retrieveOptionDetails: function () {
        var errorList = [];
        var result = [];
        var optionSet = this.refs.optionSet.refs;
        var correctAnswerCount = 0;

        for (var opt in optionSet) {
            var temp = {};
            temp.optionId = optionSet[opt].props.optionId;
            temp.optionValue = CKEDITOR.instances[optionSet[opt].props.optionId].getData();
            temp.isCorrectAnswer = optionSet[opt].state.selected;
            correctAnswerCount = temp.isCorrectAnswer ? ++correctAnswerCount : correctAnswerCount;
            if (temp.optionValue == '' || temp.optionValue == null || temp.optionValue == undefined) {
                errorList.push('option value can not be empty for ' + optionSet[opt].props.optionId);
            }
            result.push(temp);
        };

        if (errorList.length > 0) {
            return {
                errorFlag: true,
                errorList: errorList,
                correctAnswerCount: correctAnswerCount,
                data: result
            };
        } else {
            return {
                errorFlag: false,
                errorList: errorList,
                correctAnswerCount: correctAnswerCount,
                data: result
            }
        }
    },//retrieveOptionDetails

    save: function () {

        var categoryId = '',
            chapterId = '',
            questionDetails = {},
            optionDetails = [],
            answerType = '',
            totalMarks = 1;


        categoryId = this.refs.category.refs.categorySelect.value;
        chapterId = this.refs.chapter.refs.chapterSelect.value;
        questionDetails = this.retrieveQuestionDetails();
        optionDetails = this.retrieveOptionDetails();
        answerType = this.refs.answerSelection.state.answerType;
        totalMarks = this.refs.marks.refs.totalMarks.value;
        console.log('data in save...', this);

        if (!(questionDetails.errorFlag || optionDetails.errorFlag || chapterId == '' || categoryId == ''
            || optionDetails.data.length < 2 || optionDetails.correctAnswerCount == 0)) {
            if (answerType == 'radio' && optionDetails.correctAnswerCount > 1) {
                var content = '<p>Please mark only one option as answer for Radio buttons.</p>';
                raiseInfo('Encountered error(s)!', content, 'red');
            } else {

                //Save question to db.
                var questionSetup = {},
                    type = 'POST',
                    dataType = 'json',
                    createQuestionUrl = '/a/configuration/questionbank';

                questionSetup.title = questionDetails.title;
                questionSetup.body = questionDetails.body;
                questionSetup.footer = questionDetails.footer;
                questionSetup.answer = '';
                optionDetails.data.forEach(function (option) {
                    questionSetup[option.optionId] = option.optionValue;
                    questionSetup.answer += option.isCorrectAnswer ? (option.optionId + '|') : '';
                });
                questionSetup.answer_type = 'mcq';
                questionSetup.category_id = categoryId;
                questionSetup.chapter_id = chapterId;
                questionSetup.answer_selection = answerType;
                questionSetup.marks = totalMarks;

                //setup token for session so that token mismatch error is avoided;
                //As this is done on function ready. This is a global setup for token.
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    type: type,
                    url: createQuestionUrl,
                    data: questionSetup,
                    dataType: dataType,
                    beforeSend: function () {
                        $('#questionOverlay').css('display', 'block');
                    },
                    success: function (resp) {
                        $('#questionOverlay').css('display', 'none');
                        var buttons = {
                            addMore: {
                                text: 'Add More',
                                btnClass: 'btn-dark fa fa-plus',
                                action: function () {
                                    var mcqUrl = window.location.href;
                                    window.location.href = mcqUrl;
                                }
                            },
                            viewQuestion: {
                                text: 'View Question',
                                btnClass: 'btn-blue fa fa-list',
                                action: function () {
                                    var questionBank = window.location.origin + "/a/configuration/questionbank"
                                    window.location.href = questionBank;
                                }
                            }
                        };
                        raiseInfo('Success', '<p>Question saved successfully.</p>', 'green', buttons);
                    },
                    error: function (err) {
                        $('#questionOverlay').css('display', 'none');
                        console.log('Add Error...', err);
                        raiseInfo('Encountered error(s)!', err.responseJSON.errors, 'red');
                    }
                });
            }

            console.log('inside db save...', questionSetup);

        } else {

            var content = '';

            content += categoryId == '' ? '<p>Please select category.</p>' : '';
            content += chapterId == '' ? '<p>Please select chapter.</p>' : '';

            questionDetails.errorList.forEach(function (e) {
                content += '<p>' + e + '</p>';
            });

            if (optionDetails.data.length < 2) {
                content += '<p>Question must have atleast two options.</p>';
            } else {
                if (optionDetails.correctAnswerCount == 0) {
                    content += '<p>An Answer must be selected.</p>';
                }
            }

            optionDetails.errorList.forEach(function (e) {
                content += '<p>' + e + '</p>';
            });

            raiseInfo('Encountered error(s)!', content, 'red');
        }

    },//save

    preview: function () {

    },//preview

    categoryChanged: function (categoryId) {
        this.updateChapter(categoryId);
    },//categoryChagned

    updateChapter: function (categoryId) {
        this.refs.chapter.initializeChapter(categoryId);
    },//updateChapter


    render: function () {
        return (
            <div className="mcq-board well well-bg col-md-12">
                <div className='col-md-12 board-action'>
                    <span className="pull-right">
                        <button className="btn btn-warning btn-flat" onClick={this.preview}>Preview</button>
                        <button className="btn btn-success btn-flat" onClick={this.save} style={{ marginLeft: 10 + 'px' }}>Save</button>
                    </span>
                </div>
                <div className='category col-md-6'>
                    <Category ref="category" categoryChanged={this.categoryChanged}></Category>
                </div>
                <div className='chapter col-md-6'>
                    <Chapter ref="chapter"></Chapter>
                </div>

                <div className="question col-md-12">
                    <Question ref="question" action={this.props.action} questionId={this.props.questionId}></Question>
                </div>
                <div className="option col-md-12">
                    <OptionSet ref="optionSet" action={this.props.action} questionId={this.props.questionId}></OptionSet>
                </div>
                <div className="col-md-12 answer-selection" >
                    <AnswerSelection ref="answerSelection"></AnswerSelection>
                </div>
                <div className="col-md-12 answer" >
                    <Marks ref="marks"></Marks>
                </div>

            </div>
        );
    }//render

});


