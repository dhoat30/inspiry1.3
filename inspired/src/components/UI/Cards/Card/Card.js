import React from 'react'
import { GatsbyImage, getImage, StaticImage } from "gatsby-plugin-image"
import * as styles from './Card.module.css';


function Card(props) {

    const nodes = props.queryData.edges
    let element;
    const cardClass = props.cardsMargin ? `card-border-radius ${styles.cardsMargin}` : `card-border-radius`
    if (props.flex) {
        element = (<div className={`${props.flex}`}>

            {nodes.map((image, index) => {


                // const { src } = image.node.featuredImage
                if (image.node.featuredImage) {
                    const pathToImage = getImage(image.node.featuredImage.node.localFile)
                    return (
                        <div key={image.node.id}>
                            <GatsbyImage className={cardClass} image={pathToImage} alt={image.node.title} />
                        </div>
                    )
                }
            })}
        </div >);
    }
    else {
        element = (nodes.map((image, index) => {


            // const { src } = image.node.featuredImage
            if (image.node.featuredImage) {
                const pathToImage = getImage(image.node.featuredImage.node.localFile)
                return (

                    <GatsbyImage className={cardClass} key={image.node.id} image={pathToImage} alt={image.node.title} />

                )
            }
        }));
    }
    return (
        <React.Fragment>
            {element}
        </React.Fragment>

    )
}

export default Card
