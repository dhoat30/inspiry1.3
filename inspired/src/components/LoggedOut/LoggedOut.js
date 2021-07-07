// this component is showing content for logged out user- landing page

import React, { useState, useContext, useEffect } from 'react'
import LargeTitle from '../UI/Content/Titles/LargeTitle'
import ReactTypingEffect from 'react-typing-effect'
import * as styles from './LoggedOut.module.css'
import { graphql, useStaticQuery } from "gatsby"
import HomeGallery from './HomeGallery/HomeGallery';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faChevronCircleDown } from '@fortawesome/pro-light-svg-icons'
import RegisterModal from '../UI/RegisterModal/RegisterModal'
import Backdrop from '../UI/Backdrop/Backdrop'
import MenuContext from '../../store/menu-context'

import { useMediaQuery } from 'react-responsive'

import LoginModal from '../UI/LoginModal/LoginModal'
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

  const isMobile = useMediaQuery({ query: '(max-width: 500px)' })

  // use context for register form to show on register button click in the navbar
  const menuCtx = useContext(MenuContext)

  const [showRegisterForm, setRegisterForm] = useState(false)
  const [showGradient, setGradient] = useState(true)
  const [showBackdrop, setBackdrop] = useState(false)
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


  // onClick handler
  const onClickHandler = (props) => {
    setGradient(false)
    menuCtx.backdrop(true)
    setRegisterForm(true)
  }

  // close the modal 
  const closeHandler = props => {
    console.log("this is a console")
    setGradient(true)
    setBackdrop(false)
    setRegisterForm(false)
    menuCtx.visible(false)
    menuCtx.backdrop(false)
  }
  const backdropClickHandler = () => {
    menuCtx.showLoginModalFunction(false)
    setBackdrop(false)
  }
  const iconClasses = showGradient ? `${styles.iconContainer} ${styles.gradient}` : `${styles.iconContainer}`;
  const registerModalClasses = showRegisterForm || menuCtx.visibleRegisterForm ? true : false

  return (

    <div className={`${styles.typewriterContainer} row-container`}>


      {menuCtx.backdropVisibility || menuCtx.showLoginModal ? <Backdrop show={true} clicked={backdropClickHandler}></Backdrop> : null}
      {menuCtx.showLoginModal ? <LoginModal /> : null}
      {!isMobile ? <LargeTitle fontWeight="semi-bold" color="black" textAlign="center-align">Get your next</LargeTitle> : null}
      {!isMobile ?
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
        : null}


      <HomeGallery />
      {showGradient ? <a href="#registeration-form" className={iconClasses} onClick={onClickHandler}>
        <FontAwesomeIcon icon={faChevronCircleDown} size="3x" color="white" style={{ background: "#303030", borderRadius: '50%' }} />
      </a> : null}

      <RegisterModal closeModal={closeHandler} visibleClasses={registerModalClasses} />
    </div>

  )
}

export default LoggedOut
