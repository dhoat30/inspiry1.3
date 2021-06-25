import React from 'react'

function ColumnTitle(props) {
    return (
        <div>
            <React.Fragment>
                <h3 className={`column-size position-relative ${props.color} ${props.fontWeight} ${props.textAlign}`}>{props.children}</h3>
            </React.Fragment>
        </div>
    )
}

export default ColumnTitle
