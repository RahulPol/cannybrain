window.Marks = React.createClass({

    componentWillReceiveProps: function (nextProps) {
        this.refs.totalMarks.value = nextProps.defaultValue; //numeral(nextProps.defaultValue, "0[.]0");
    },

    render: function () {
        return (
            <div className="marks-content">
                <span className="title">Marks</span>
                <br></br>
                <input ref="totalMarks" style={{ marginLeft: 16 + 'px' }} type="number" defaultValue={this.props.defaultValue} ></input>
            </div>
        )
    }
});