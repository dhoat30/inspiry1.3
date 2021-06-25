import React from 'react'
import { GatsbyImage, getImage, StaticImage } from "gatsby-plugin-image"
import * as styles from './Card.module.css';


function Card(props) {

    const nodes = props.queryData.edges
    return (
        <div className={`${props.flex}`}>
            {nodes.map((image, index) => {


                // const { src } = image.node.featuredImage
                if (image.node.featuredImage) {
                    const pathToImage = getImage(image.node.featuredImage.node.localFile)
                    return (
                        <div key={image.node.id}>
                            <GatsbyImage className={`card-border-radius ${styles.cards}`} image={pathToImage} alt={image.node.title} />
                        </div>
                    )
                }
            })}
        </div >
    )
}

export default Card
