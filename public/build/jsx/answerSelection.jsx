window.AnswerSelection = React.createClass({
    getInitialState: function () {
        return {
            answerSelection: 'checkbox'
        }
    },//getInitialState

    _onOptionChange: function (option) {
        this.setState({
            answerSelection: option
        });
    },

    componentWillReceiveProps: function (nextProps) {
        this.setState({
            answerSelection: nextProps.selection
        })
    },//componentWillReceiveProps

    render: function () {
        return (
            <div className="answer-selection-content">
                <span className="title">Answer Selection</span>
                <div className="radio">
                    <label htmlFor="radio">Radio buttons (only one answer option can be selected)</label>
                    <input id="radio" onClick={this._onOptionChange.bind(this, 'radio')} type="radio" name="answerSelection" defaultChecked={this.state.answerSelection == 'radio'} style={{ marginLeft: 8 + 'px' }}></input>
                </div>
                <div className="radio">
                    <label htmlFor="checkbox">Checkboxes (multiple answer options can be selected)</label>
                    <input id="checkbox" onClick={this._onOptionChange.bind(this, 'checkbox')} type="radio" name="answerSelection" defaultChecked={this.state.answerSelection == 'checkbox'} style={{ marginLeft: 16 + 'px' }} ></input>
                </div>
            </div>
        )
    }
});