window.AnswerSelection = React.createClass({
    getInitialState: function () {
        return {
            answerType: 'checkbox'
        }
    },//getInitialState

    _onOptionChange: function (option) {
        this.setState({
            answerType: option
        });
    },

    render: function () {
        return (
            <div className="answer-selection-content">
                <span className="title">Answer Selection</span>
                <div className="radio">
                    <label htmlFor="radio">Radio buttons (only one answer option can be selected)</label>
                    <input id="radio" onClick={this._onOptionChange.bind(this, 'radio')} type="radio" name="answerType" defaultChecked={this.state.answerType == 'radio'} style={{ marginLeft: 8 + 'px' }}></input>
                </div>
                <div className="radio">
                    <label htmlFor="checkbox">Checkboxes (multiple answer options can be selected)</label>
                    <input id="checkbox" onClick={this._onOptionChange.bind(this, 'checkbox')} type="radio" name="answerType" defaultChecked={this.state.answerType == 'checkbox'} style={{ marginLeft: 16 + 'px' }} ></input>
                </div>
            </div>
        )
    }
});