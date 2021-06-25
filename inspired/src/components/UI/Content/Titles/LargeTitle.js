import React from 'react'

function LargeTitle(props) {
    return (
        <React.Fragment>
            <h1 className={`large-size position-relative ${props.color} ${props.fontWeight} ${props.textAlign}`}>{props.children}</h1>
        </React.Fragment>
    )
}

export default LargeTitle
