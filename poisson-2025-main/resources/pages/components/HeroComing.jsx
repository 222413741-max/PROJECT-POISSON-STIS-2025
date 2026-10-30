import React, { useState } from 'react'
import styled, { keyframes } from 'styled-components'
import tw from 'twin.macro'

import VideoSection from './VideoSection'
import { Container, ContentWithVerticalPadding } from './misc/Layouts'

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import {
  faInstagram,
  faYoutube,
  faTiktok,
} from '@fortawesome/free-brands-svg-icons'
import {
  faEnvelope,
  faChevronDown,
  faChevronUp,
} from '@fortawesome/free-solid-svg-icons'
import { useTranslation } from 'react-i18next'

import Cookies from 'js-cookie'

// Animations
const fadeInUp = keyframes`
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
`

const blink = keyframes`
  0%, 25%, 50% {
    content: "";
  }
  75%, 100% {
    content: ".";
  }
`

const blinkAnimation = keyframes`
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
`

const slideInFromTop = keyframes`
  from {
    transform: translateY(-100%);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
`

const slideInFromRight = keyframes`
  from {
    transform: translateX(100%);
    opacity: 0;
  }
  to {
    transform: translateX(0);
    opacity: 1;
  }
`

const slideInFromLeft = keyframes`
  from {
    transform: translateX(-100%);
    opacity: 0;
  }
  to {
    transform: translateX(0);
    opacity: 1;
  }
`

const transparentShow = keyframes`
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
`

const Text = styled.div`
  ${tw`text-4xl lg:text-6xl font-bold text-gray-900 mt-16 xl:mt-24 lg:mt-20 sm:mt-4 relative`}
  margin-top: 15vh;
  animation: ${fadeInUp} 1s ease-out 2s both;

  @media (max-width: 768px) {
    margin-top: 12vh;
    padding: 0 2rem;
    font-size: 3rem;
  }

  &:after {
    ${tw`inline-block`}
    content: "";
    width: 0;
    overflow: hidden;
    display: inline-block;
    vertical-align: bottom;
    animation: ${blink} 1s steps(4, end) infinite;
  }
`

// Styled Components
const FullHeightContainer = styled(Container)`
  ${tw`flex flex-col justify-center items-center min-h-screen relative overflow-hidden`}
`

const CenteredContent = styled.div`
  ${tw`text-center flex flex-col items-center relative`}
  z-index: 4;
  animation: ${fadeInUp} 1s ease-out both;

  @media (max-width: 768px) {
    padding-top: 1vh;
  }
`

const ImageContainer = styled.div`
  ${tw`relative flex items-center justify-center mb-10`}
  width: 100%;
  height: 33vh;

  @media (max-width: 768px) {
    height: 20vh;
  }
`

const Image = styled.img`
  ${tw`max-w-full`}
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 33vw;
  animation: ${fadeInUp} 1s ease-out both;

  @media (max-width: 768px) {
    width: 60vw;
  }

  @media (max-width: 425px) {
    width: 80vw;
  }
`

const Image1 = styled(Image)`
  ${tw`absolute left-0`}
  top: -10vh;
  animation: ${slideInFromTop} 1s ease-out both;
  animation-delay: 0.5s;
`

const Image2 = styled(Image)`
  ${tw`absolute left-0`}
  top: -8vh;
  animation: ${slideInFromLeft} 1s ease-out both;
  animation-delay: 1s;
`

const Image3 = styled(Image)`
  ${tw`absolute left-0`}
  top: -10vh;
  animation: ${slideInFromRight} 1s ease-out both;
  animation-delay: 1.5s;
`

const TagLine = styled.p`
    ${tw`text-lg text-gray-700`}
    animation: ${fadeInUp} 1s ease-out 2.5s both;
`

const ImageRight = styled.img`
  ${tw`max-w-full`}
  position: fixed;
  bottom: 0;
  right: 0;
  transform: translate(50%, 50%);
  width: 50vw;
  z-index: 3;

  @media (max-width: 768px) {
    width: 40vw;
  }

  @media (max-width: 425px) {
    width: 60vw;
  }
`

const ImageLeft = styled.img`
  ${tw`max-w-full`}
  position: fixed;
  bottom: 0;
  left: 0;
  transform: translate(0, 0);
  width: 43vw;
  z-index: 3;

  @media (max-width: 768px) {
    width: 40vw;
  }

  @media (max-width: 425px) {
    width: 60vw;
  }
`

const ImageTopRight = styled.img`
  ${tw`max-w-full`}
  position: fixed;
  top: 0;
  right: 0;
  transform: translate(50%, -50%);
  width: 50vw;
  z-index: 3;

  @media (max-width: 768px) {
    width: 40vw;
  }

  @media (max-width: 425px) {
    width: 60vw;
  }
`

const ImageTopLeft = styled.img`
  ${tw`max-w-full`}
  position: fixed;
  top: 0;
  left: 0;
  transform: translate(-50%, -50%);
  width: 40vw;
  z-index: 3;

  @media (max-width: 768px) {
    width: 40vw;
  }

  @media (max-width: 425px) {
    width: 60vw;
  }
`

const SocialIconsContainer = styled.div`
  ${tw`flex justify-center mt-4`}
`

const SocialIcon = styled.a`
  ${tw`text-gray-700 mx-2 hover:text-gray-900`}
  font-size: 2rem;
  display: inline-block;
  transition: transform 0.3s ease-in-out;

  &:hover {
    transform: translateY(-5px);
    color: #1da1f2;
  }
`

const LangWrapper = tw.div`w-full flex justify-end z-10`

const LangDropdown = tw.div`relative flex items-center justify-between bg-white cursor-pointer py-2 px-4 rounded w-[120px]`

const LangDropdownContent = tw.div`flex gap-2 items-center w-full`

const LangDropdownList = styled.div`
  ${tw`absolute bg-white top-[45px] left-0 cursor-pointer w-full rounded-[5px]`}
  display: none;
  animation: ${transparentShow} 1s ease-in-out;
`

const LangDropdownItem = tw.div`flex items-center hover:bg-gray-300 gap-2 py-2 px-4 rounded-[5px] w-full`

const CountryFlag = styled.img`
  height: 20px;
  width: 30px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
`

const HeroComing = () => {
  const { t, i18n } = useTranslation()

  const [selectedLang, setSelectedLang] = useState(Cookies.get('lang') || 'en')
  const handleLangChange = (e) => {
    const lang = e.target.getAttribute('value')
    if (i18n.language !== lang) {
      i18n.changeLanguage(lang)
      Cookies.set('lang', lang)
      setSelectedLang(lang)
    }
  }

  const [isClick, setIsClick] = useState(false)
  const clickDropdown = () => {
    setIsClick(!isClick)
  }

  return (
    <>
      <FullHeightContainer>
        <LangWrapper>
          <LangDropdown onClick={clickDropdown}>
            <LangDropdownContent>
              <CountryFlag
                src={selectedLang === 'en' ? '/img/en.png' : '/img/id.png'}
              />
              <span tw="w-full">{selectedLang === 'en' ? 'EN' : 'ID'}</span>
              <FontAwesomeIcon icon={isClick ? faChevronUp : faChevronDown} />
            </LangDropdownContent>
            <LangDropdownList
              style={isClick ? { display: 'block' } : { display: 'none' }}
            >
              <LangDropdownItem onClick={handleLangChange} value="en">
                <CountryFlag src="/img/en.png" value="en" />
                <span value="en">EN</span>
              </LangDropdownItem>
              <LangDropdownItem onClick={handleLangChange} value="id">
                <CountryFlag src="/img/id.png" value="id" />
                <span value="id">ID</span>
              </LangDropdownItem>
            </LangDropdownList>
          </LangDropdown>
        </LangWrapper>
        <ImageTopRight src="/img/landing-page/blue.svg" />
        <ImageTopLeft src="/img/landing-page/star.svg" />
        <ContentWithVerticalPadding>
          <CenteredContent>
            <ImageContainer>
              <Image1 src="/img/landing-page/1.png" alt="Logo 1" />
              <Image2 src="/img/landing-page/2.png" alt="Logo 2" />
              <Image3 src="/img/landing-page/3.png" alt="Logo 3" />
            </ImageContainer>
            <Text>
              {t('comingsoon.header')}
              <BlinkingDots />
            </Text>
            <TagLine>{t('comingsoon.message')}</TagLine>
            <SocialIconsContainer>
              <SocialIcon
                href="https://www.instagram.com/poisson_stis/"
                target="_blank"
                rel="noopener noreferrer"
              >
                <FontAwesomeIcon icon={faInstagram} />
              </SocialIcon>
              <SocialIcon
                href="https://www.youtube.com/@POISSONPolstatSTIS/featured"
                target="_blank"
                rel="noopener noreferrer"
              >
                <FontAwesomeIcon icon={faYoutube} />
              </SocialIcon>
              <SocialIcon
                href="http://tiktok.com/@poisson_stis"
                target="_blank"
                rel="noopener noreferrer"
              >
                <FontAwesomeIcon icon={faTiktok} />
              </SocialIcon>
              <SocialIcon
                href="mailto:poisson@stis.ac.id"
                target="_blank"
                rel="noopener noreferrer"
              >
                <FontAwesomeIcon icon={faEnvelope} />
              </SocialIcon>
            </SocialIconsContainer>
          </CenteredContent>
        </ContentWithVerticalPadding>
        <ImageRight src="/img/landing-page/pink_star.svg" />
        <ImageLeft src="/img/landing-page/blue.svg" />
      </FullHeightContainer>
      <VideoSection />
    </>
  )
}

const BlinkingDots = () => {
  return (
    <span
      css={`
                ${tw`inline-block`}
                animation: ${blinkAnimation} 1s steps(4, end) infinite;
            `}
    >
      ...
    </span>
  )
}

export default HeroComing
