window.Marks = React.createClass({

    _onOptionChange: function (option) {
        this.setState({
            answerType: option
        });
    },

    render: function () {
        return (
            <div className="marks-content">
                <span className="title">Marks</span>
                <br></br>
                <input ref="totalMarks" style={{ marginLeft: 16 + 'px' }} type="number" defaultValue="1"></input>
            </div>
        )
    }
});