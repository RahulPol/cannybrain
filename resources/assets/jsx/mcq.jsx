
var Option = React.createClass({

    getInitialState: function () {
        return { selected: false }
    },

    onTickClicked: function () {
        this.setState({ selected: !this.state.selected });
    },//onTickClicked

    componentDidUpdate: function () {
        CKEDITOR.instances[this.props.optionId].setData(this.props.optionValue);
    },

    componentDidMount: function () {
        CKEDITOR.replace(this.props.optionId);
    },//componentDidMount


    remove: function () {
        console.log("Removing comment");
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
                        <button className="btn btn-danger btn-flat" onClick={this.remove} style={{ marginLeft: 10 + 'px' }}><i className="fa fa-trash"></i></button>
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

            console.log();
            this.setState({ options: arr });
        } else {
            alert('enough options');
        }
    },//add

    remove: function (position) {

        var arr = this.state.options;
        this.setState({ options: [] })
        console.log('arr', arr);
        var result = [];
        var shiftFlag = false;
        for (var i = 0, l = arr.length - 1; i < l; i++) {
            var option = arr[i];
            if (i == position) {
                shiftFlag = true;
            }

            if (shiftFlag) {
                option.body = CKEDITOR.instances['option' + arr[i + 1].text.toString()].getData();
            } else {
                option.body = CKEDITOR.instances['option' + arr[i].text.toString()].getData();
            }

            result.push(option);
        }

        console.log('result array', result);

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
        var question = this.refs.question;

        return {};
    },//retrieveQuestionDetails

    retrieveOptionDetails: function () {
        var optionSet = this.refs.OptionSet;
        return [];
    },//retrieveOptionDetails

    save: function () {
        console.log(this);
        var questionDetails = {},
            optionDetails = [];

        questionDetails = this.retrieveQuestionDetails();
        optionDetails = this.retrieveOptionDetails();


    },//save

    preview: function () {

    },//preview

    render: function () {
        return (
            <div className="mcq-board well well-bg col-md-12">
                <div>
                    <span className="question-title">Question</span>
                    <span className="pull-right">
                        <button className="btn btn-warning btn-flat" onClick={this.preview}>Preview</button>
                        <button className="btn btn-success btn-flat" onClick={this.save} style={{ marginLeft: 10 + 'px' }}>Save</button>
                    </span>
                </div>
                <div className="question col-md-12">
                    <Question ref="question" action={this.props.action} questionId={this.props.questionId}></Question>
                </div>
                <div className="option col-md-12">
                    <OptionSet ref="optionSet" action={this.props.action} questionId={this.props.questionId}></OptionSet>
                </div>

            </div>
        );
    }//render

});


