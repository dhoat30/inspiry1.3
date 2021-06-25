import React from 'react'

function Paragraph(props) {
    return (
        <React.Fragment>
            <p className={`paragraph-size position-relative ${props.color} ${props.fontWeight} ${props.textAlign}`}>{props.children}</p>
        </React.Fragment>
    )
}

export default Paragraph
