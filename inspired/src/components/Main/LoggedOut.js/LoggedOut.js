// this component is showing content for logged out user- landing page

import React from 'react'
import LargeTitle from '../../UI/Content/Titles/LargeTitle'
import ReactTypingEffect from 'react-typing-effect'
import * as styles from './LoggedOut.module.css'
import { graphql, useStaticQuery } from "gatsby"
import HomeGallery from '../HomeGallery/HomeGallery';
const query = graphql`
  {
    allWpTypewriter(
      filter: {typewriterCategories: {nodes: {elemMatch: {slug: {eq: "be-inspired"}}}}}
    ) {
      edges {
        node {
          id
          title
          typewriterCategories {
            nodes {
              name
            }
          }
        }
      }
    }
  }`;
function LoggedOut() {
    // get data
    let data = useStaticQuery(query);

    //id array
    let id = data.allWpTypewriter.edges.map(edge => {
        return edge.node.id
    });
    // title array 
    let title = data.allWpTypewriter.edges.map(edge => {
        return edge.node.title
    });

    return (

        <div className={`${styles.typewriterContainer} margin-row-v row-container`}>
            <LargeTitle fontWeight="semi-bold" color="black" textAlign="center-align">Get your next</LargeTitle>

            <ReactTypingEffect className="margin-auto"
                text={title}
                speed={50}
                eraseDelay={2000}
                eraseSpeed={50}
                typingDelay={1000}
                cursorRenderer={cursor => <LargeTitle fontWeight="semi-bold" color="blue" textAlign="center-align">{cursor}</LargeTitle>}
                displayTextRenderer={(text, i) => {
                    return (
                        <LargeTitle fontWeight="semi-bold" color="blue" textAlign="center-align">
                            {text.split('').map((char, i) => {
                                const key = `${i}`;
                                return (
                                    <span className="center-align margin-auto"
                                        key={key}

                                    >{char}</span>
                                );
                            })}
                        </LargeTitle>
                    );
                }}
            />

            <HomeGallery />
        </div>

    )
}

export default LoggedOut
