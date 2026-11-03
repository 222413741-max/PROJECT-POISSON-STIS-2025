import React, { useState, useEffect } from 'react';
import { useTranslation } from 'react-i18next';
import Cookies from 'js-cookie';
import styled from "styled-components";
import tw from "twin.macro";
import { motion, AnimatePresence } from 'framer-motion';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faChevronDown, faChevronUp } from '@fortawesome/free-solid-svg-icons';
import { useRef } from 'react';

//header
const PageContainer = styled.div`
  ${tw`
    bg-cover bg-center min-h-screen w-full 
    relative
    flex justify-center items-start 
    px-4 sm:px-6 md:px-8
    py-0
  `}
  background-image: url("/img/comingsoon/background.png");
`;

const HeaderFlowers = tw.img`
  absolute top-[0vh]
  w-full 
  z-60
  pointer-events-none
`;

const BubblesDecoration = tw.img`
  absolute 
  left-[-1vw] 
  top-[5vh]
  width[15vw]
  z-40
`;

const ContentCard = styled.div`
  ${tw`
    relative      
    w-full
    max-w-screen-xl 
    mb-0                  
    rounded-t-[40px]
    rounded-b-none   
    opacity-90
    shadow-[0px 4px 4px rgba(0,0,0,0.25)]
    min-h-[calc(100vh-59px)]
    z-30
  `}
  background-image: linear-gradient(180deg, rgba(255,255,255,0.8) 75%, rgba(255,255,255,0) 85%, rgba(255,238,193,0) 87%, rgba(255,222,131,0.8) 100%);
`;

const ContentWrapper = tw.div`
  relative w-full h-full 
  flex flex-col items-center justify-start
  text-center
  px-4 sm:px-6 md:px-12
  pt-4
`;

const HeaderLine = styled.img`
  ${tw`
    absolute
    top-[1vh]
    z-50
    w-[40vw]
  `}
  filter: drop-shadow(1px 1px 2px rgba(0,4,4,0.5))
`;

const PositioningWrapper = styled.div`
  ${tw`
    relative  
    w-full
    max-w-screen-xl      
    mt-[25px] md:mt-[50px]
  `}
`;

//language
const LanguageContainer = tw.div`    
    absolute
    top-4 right-4
    sm:top-6 sm:right-6
    xl:right-8
    z-70      
    w-auto   
`;

const LanguageButton = styled.button`
  ${tw`
    w-[70px] h-[28px] md:w-[110px] md:h-[48px] p-3
    flex items-center justify-between
    font-lato font-black text-[#3A4F6E]
    rounded-[14px]
    shadow-[0 4px 4px rgba(0,0,0,0.2)]
    transition-all duration-300 ease-out
    cursor-pointer
    border-none
  `}
  
  background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), 
              linear-gradient(108deg, #FAE8B3 0%, #F2C5B4 100%, #5DFFBE 200%);
  background-origin: border-box;
  background-clip: padding-box, border-box;

  &:active {
    transition-duration: 0.1s;
  }
`;

const DropdownMenuContainer = styled(motion.div)`
  ${tw`
    absolute top-full right-0 mt-[10px]
    min-w-[140px]
    rounded-[12px]
    shadow-[0 4px 4px rgba(0,0,0,0.2)]
    z-[1001]
    overflow-hidden
  `}
  
  background-image: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), 
                    linear-gradient(108deg, #FAE8B3 0%, #F2C5B4 100%, #5DFFBE 200%);
  background-origin: border-box;
  background-clip: padding-box, border-box;
`;

const DropdownMenuItem = styled(motion.div)`
  ${tw`
    text-[#3A4F6E] px-4 py-[14px]
    flex items-center gap-[10px]
    text-[14px] font-black font-lato
    transition-all duration-200 ease-out
    cursor-pointer
    bg-transparent
  `}

  &:hover {
    background: linear-gradient(90deg, #F2C5B4 0%, #FAE8B3 100%);
  }

  &:first-child {
    ${tw`rounded-t-[12px]`}
  }

  &:last-child {
    ${tw`rounded-b-[12px]`}
  }
`;

//title
const TitleContainer = tw.div`
  w-full
  py-8 md:py-12
  flex flex-col items-center justify-center 
  gap-4 md:gap-8
  lg:flex-row lg:gap-24
  md:flex-row md:gap-4
  mt-6
  md:mt-12
  lg:mt-16
`;

const TextBlock = tw.div`
  flex flex-col 
  items-center     
  lg:items-end
  md:items-end
  order-2 lg:order-1 md:order-1
`;

const TitleLine = styled.div`
  ${tw`
    font-playfair font-black
    text-6xl sm:text-7xl md:text-7xl lg:text-8xl 
    tracking-wide 
    text-transparent bg-clip-text 
    text-center lg:text-left md:text-left 
    pb-3
  `}
  background-image: linear-gradient(90deg, #004c52 -25%, #119faa 0%, #4ac2c3 50%,#f9cd55 90%, #f9cd55 100%);
  filter: drop-shadow(4px 4px 2px #FAFADA );
  & .first-letter {
    font-style: italic;
  }
`; 

const LogoImage = tw.img`
  order-1 lg:order-2 md:order-2
  w-[13rem] h-[13rem]
  md:w-[15rem] md:h-[15rem] 
  lg:w-[17rem] lg:h-[17rem] 
  lg:-ml-24 
`;

//countdown
const CountdownWrapper = tw.div`
w-full max-w-lg mx-auto flex flex-col justify-center
`;

const Subtitle = styled.p`
  ${tw`
    text-lg lg:text-2xl font-bold tracking-wide 
    font-lato text-transparent bg-clip-text italic
  `}
  background-image: linear-gradient(87deg, #FBB476 -25%,#FBB476 5%, #31DFA2 30%, #00D89B 60%, #EAE321 80%, #EAE321 110%);
  filter: drop-shadow(1px 1px 0px #FAFADA)
`;

const CountdownGrid = tw.div`
  flex flex-col md:flex-row items-center md:items-center justify-center gap-2 md:gap-3 text-center mt-6
`;

const TimeUnitWrapper = tw.div`
  flex flex-col items-center gap-2 justify-center
`;

const DigitBoxWrapper = tw.div`
  flex items-center gap-1 md:gap-2
`;

const TimeBox = styled.div`
  ${tw`
backdrop-blur-sm rounded-xl p-2
w-20 h-24 md:w-16 md:h-20 lg:w-20 lg:h-24 
flex items-center justify-center transition-transform 
duration-300 hover:scale-105 cursor-default
  `}
  background-image: linear-gradient(180deg, #55F3EB80 0%, #4AEF9C80 43%,#52E33F80 100%);
  box-shadow: 5px 5px 15px rgba(0,4,4,0.25), inset -2px -2px 8px rgba(0,0,0,0.15), inset 2px 2px 8px rgba(255,255,255,0.4);
  border: 1px solid #FFFFFF;
`;

const TimeValue = styled.div`
  ${tw`
    relative pb-2
    text-7xl sm:text-7xl md:text-5xl lg:text-7xl 
    leading-none font-black font-playfair text-transparent bg-clip-text
  `}
  filter: drop-shadow(1px 1px 2px rgba(0,4,4,0.5)) brightness(110%);
  background-image: linear-gradient(180deg, #9EB8EA -30%, #E5AEC2 10%,#FFA768 60%, #EABC3C 100%);
`;

const TimeLabel = tw.div`
  text-sm md:text-base lg:text-lg
  uppercase tracking-widest text-[#EA8D3C] font-bold
  font-playfair
`;

const Separator = styled.div`
  ${tw`
  hidden md:block              
  font-playfair
  text-3xl md:text-5xl lg:text-6xl 
  pt-1 md:pt-3 lg:pt-5
  rounded-full
  text-transparent bg-clip-text
  `}
  background-image: linear-gradient(180deg, #55F3EB80 0%, #4AEF9C80 43%,#52E33F80 100%);
`;

//Teaser
const TeaserWrapper = tw.div`
  w-full flex flex-col items-center py-16 px-4
`;

const TeaserTitle = styled.h2`
  ${tw`
    text-3xl md:text-4xl lg:text-5xl font-playfair font-bold italic tracking-wide text-center mb-8 lg:mb-12
    p-2
    text-transparent bg-clip-text
  `} 
  background-image: linear-gradient(88deg, #1D78CE -10%,#1D78CE 10%, #00D89B 25%, #A4C183 65%, #FBB476 80%, #FBB476 100%);
  filter: drop-shadow(2px 2px 0px #FAFADA)
`;

const TeaserContentContainer = tw.div`
  w-full max-w-6xl mx-auto flex flex-col lg:flex-row 
  items-center justify-center 
  gap-12 lg:gap-16
`;

const TeaserSubtitleContainer = tw.div`
  flex-1 flex justify-center lg:justify-end text-center lg:text-left
`;

const TeaserSubtitle = styled.p`
  ${tw`
    text-base md:text-lg lg:text-2xl max-w-lg
    font-lato font-bold italic leading-relaxed mt-0 md:mt-4 lg:-mt-0
    mb-4 md:mb-8 lg:mb-0 lg:ml-4
    
  `}
  color: #FFFCEA;
  -webkit-text-stroke: 1px #004C52;
  text-stroke: 1px #004C52;
  filter: drop-shadow(2px 2px 4px rgba(0,4,4,0.2));

  @media (max-width: 768px) {
  -webkit-text-stroke: 0.8px #004C52;
  text-stroke: 0.8px #004C52;
  filter: drop-shadow(2px 2px 4px rgba(0,4,4,0.2));
  }
`;

const TeaserDecoratedVideoContainer = styled.div`
  ${tw`
    relative w-full flex justify-center flex-1
  `}
  max-width: 640px; 
`;

const VideoFrame = styled.div`
  ${tw`
    relative p-3 md:p-4 rounded-2xl shadow-lg w-full
  `}
  background-image: linear-gradient(-88deg, #D9F6F6 0%,#FEFDD9 15%, #AEDFB0 40%, #4EC0AD 67%, #39AFAD 100%);
`;

const ResponsiveVideoWrapper = styled.div`
  ${tw`
    relative w-full rounded-lg overflow-hidden z-50
  `}
  padding-top: 56.25%;
`;

const VideoPlayer = tw.iframe`
  absolute top-0 left-0 w-full h-full border-0
`;

const PlantDecoration = tw.img`
  absolute inset-0 w-full h-full object-contain pointer-events-none z-40
  top-2 right-5
`;

const StarDecoration = tw.img`
    absolute pointer-events-none z-60
    w-full h-auto 
    top-[-13%]  transform -translate-x-1/2
    lg:top-[-13%] lg:w-[80vh] lg:left-2
`;

const LeftRockDecoration = tw.img`
  absolute  
  -bottom-8 md:-bottom-12 -left-6  md:-left-12 
  w-20 md:w-32 pointer-events-none z-60
`;

const RightRockDecoration = tw.img`
  absolute 
  -bottom-8 md:-bottom-12 -right-6 md:-right-12 
  w-20 md:w-32 pointer-events-none z-60
`;

//CTA
const CtaWrapper = tw.div`
  w-full flex flex-col items-center py-16 px-4 z-60
`;

const CtaContentWrapper = tw.div`
  w-full max-w-6xl mx-auto flex flex-col lg:flex-row 
  items-center justify-center 
  gap-8 lg:gap-10
`;

const CtaTitle = styled.h2`
  ${tw`
    text-3xl font-lato font-bold italic tracking-wide text-center 
    mb-4 lg:mb-12 p-2
    `}
  background: linear-gradient(88deg, #406CFF 0%,  #31DFA2 40%, #00D89B 70%, #FBBB32 100%);
  filter: drop-shadow(2px 2px 0px #FAFADA);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
`;

const CtaSubtitle = styled.h3`
  ${tw`
    text-lg md:text-xl lg:text-2xl mt-2 lg:mt-4 
    font-bold italic leading-tight font-lato bg-clip-text
    `}
  color: #FFFCEA;
  -webkit-text-stroke: 1px #004C52;
  text-stroke: 1px #004C52;
  filter: drop-shadow(2px 2px 6px rgba(0, 76, 82, 0.1));
  filter: drop-shadow(1px 1px 2px rgba(0,4,4,0.5));

  @media (max-width: 768px) {
  -webkit-text-stroke: 0.5px #004C52;
  text-stroke: 0.5px #004C52;
  filter: drop-shadow(1px 1px 6px rgba(0, 76, 82, 0.1));
  filter: drop-shadow(1px 1px 2px rgba(0,4,4,0.5));
`;

const CtaButton = styled.a`
  ${tw`
  mt-0 lg:mt-4 text-white font-bold italic font-lato
  py-2 px-6 rounded-xl text-lg hover:scale-105 
  transition-transform inline-block cursor-pointer
  text-[#5E8B9A]
  `}
  background: linear-gradient(72deg, #FAE8B3 0%, #F2C5B4 100%, #5DFFBE 140%);
  border: 2px solid rgba(255, 255, 255, 0.51);
  text-decoration: none;
  &:hover {
    text-decoration: none;
  }
  filter: drop-shadow(2px 2px 6px rgba(0, 76, 82, 0.5));
    &:hover {
    transform: scale(1.08) translateY(-3px);
    box-shadow: 0 10px 30px rgba(0, 76, 82, 0.3);
    background: linear-gradient(72deg, #FCECBF 0%, #F5D1C0 100%, #6AFFCA 140%);
    text-decoration: none;
  }
  
  &:active {
    transform: scale(0.95) translateY(-1px);
  }
  
  &::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255,255,255,0.3);
    transition: width 0.6s, height 0.6s;
    transform: translate(-50%, -50%);
    z-index: 0;
  }
  
  &:active::before {
    width: 300px;
    height: 300px;
  }
`;

const ButtonWrapper = styled.div`
  ${tw`flex justify-center`}
`;


//Footer & Sosmed
const FooterWrapper = tw.footer`
  mt-4 md:mt-8 lg:mt-12 w-full flex flex-col items-center 
  space-y-4 pb-32 lg:pb-40 z-50
`;

const SocialLinksContainer = tw.div`
flex items-center space-x-6
`;

const SocialLink = tw.a`
text-white text-opacity-70 hover:text-opacity-100 
hover:scale-110 transition-all duration-300
`;

const SocialIcon = styled.img`
  ${tw`
    w-8 h-8 sm:w-10 sm:h-10 lg:w-14 lg:h-14 hover:scale-110 transition-all duration-300
  `}
  &:hover {
    transform: scale(1.2) rotate(10deg) translateY(-5px);
    filter: brightness(1.2) drop-shadow(0 5px 15px rgba(0,0,0,0.3));
  }
  
  &:active {
    transform: scale(1.1) rotate(5deg) translateY(-2px);
  }
`;

//Hiasan bawah
const FooterLine = styled.img`
  ${tw`
    w-[50vw] h-auto md:w-[40vw] lg:w-[40vw] 
    absolute bottom-20 left-[26%] md:bottom-14 md:left-[30%] transform -translate-x-1/2
    z-50
  `}
  filter: drop-shadow(1px 1px 2px rgba(0,4,4,0.5))
`;

const BgLayer3 = tw.img`
  absolute -bottom-14 transform -translate-x-1/2
  pointer-events-none z-0
  w-[100vw] md:w-[100vw] lg:w-[100vw]
  h-auto
  min-w-[1200px]
  object-cover object-bottom
`;

const BgLayer2 = tw.img`
  absolute -bottom-14 transform -translate-x-1/2
  pointer-events-none z-10
  w-[100vw] md:w-[100vw] lg:w-[100vw]
  h-auto
  min-w-[1200px]
  object-cover object-bottom
`;

const HiasanKanan = tw.img`
  absolute right-0 -bottom-4 lg:right-10 
  transform -translate-x-1/2
  w-32 md:w-48 lg:w-64 h-auto
  z-20 pointer-events-none
`;

const HiasanKiri = tw.img`
  absolute left-0 bottom-0 lg:left-10 lg:bottom-4
  transform -translate-x-1/2
  w-32 md:w-48 lg:w-64 h-auto
  z-20 pointer-events-none
`;

const BgLayer1 = tw.img`
  absolute bottom-0 left-[1px] right-0
  w-[100vw] h-auto
  z-40 pointer-events-none
`;

const CopyNotification = styled(motion.div)`
  ${tw`
    fixed bottom-10 left-1/2 
    bg-gray-800 text-white 
    px-4 py-2 rounded-lg shadow-lg
    z-100
  `}
  transform: translateX(-50%);
`;

// --- Komponen Utama ---
const COUNTDOWN_TARGET_DATE = new Date("2025-09-02T00:00:00");

const calculateTimeLeft = () => {
    const difference = COUNTDOWN_TARGET_DATE - new Date();
    let timeLeft = {};
    if (difference > 0) {
        timeLeft = {
            days: Math.floor(difference / (1000 * 60 * 60 * 24)),
            hours: Math.floor((difference / (1000 * 60 * 60)) % 24),
            minutes: Math.floor((difference / 1000 / 60) % 60),
            seconds: Math.floor((difference / 1000) % 60)
        };
    }
    return timeLeft;
};

const HeroComing = () => {

  const { t, i18n } = useTranslation();
  const [selectedLang, setSelectedLang] = useState(Cookies.get('lang') || 'id');
  const [isClick, setIsClick] = useState(false);
  const [timeLeft, setTimeLeft] = useState(calculateTimeLeft());
  const [isLoading, setIsLoading] = useState(false); 
  const dropdownRef = useRef(null);

  useEffect(() => {
      const timer = setInterval(() => { setTimeLeft(calculateTimeLeft()); }, 1000);
      return () => clearInterval(timer);
  }, []);

  const handleLangChange = async (lang) => {
      if (i18n.language !== lang) {
          setIsLoading(true);
          await i18n.changeLanguage(lang);
          Cookies.set('lang', lang);
          setSelectedLang(lang);
          setIsClick(false);
          setIsLoading(false);
      }
  };

  const clickDropdown = () => { setIsClick(prevIsClick => !prevIsClick); };

    useEffect(() => {
        const handleClickOutside = (event) => {
            if (dropdownRef.current && !dropdownRef.current.contains(event.target)) {
                setIsClick(false); 
            }
        };
        document.addEventListener('mousedown', handleClickOutside);
        return () => {
            document.removeEventListener('mousedown', handleClickOutside);
        };
    }, []);

      const dropdownVariants = {
    closed: {
      opacity: 0,
      y: -10,
      scale: 0.95,
      transition: { 
        duration: 0.2, 
        ease: "easeInOut" 
      }
    },
    open: {
      opacity: 1,
      y: 0,
      scale: 1,
      transition: { 
        duration: 0.3, 
        ease: "easeOut",
        staggerChildren: 0.08,
        delayChildren: 0.1
      }
    }
  };

  const addLeadingZero = (value) => { return value < 10 ? `0${value}` : value; };

  const days = addLeadingZero(timeLeft.days || 0).toString();
  const hours = addLeadingZero(timeLeft.hours || 0).toString();
  const minutes = addLeadingZero(timeLeft.minutes || 0).toString();
  const seconds = addLeadingZero(timeLeft.seconds || 0).toString();

  const socialLinks = [
    { 
      href: "https://www.instagram.com/poisson_stis", 
      icon: "/img/comingsoon/instagram.png", 
      alt: "Instagram",
      color: "#E4405F"
    },
    { 
      href: "https://www.tiktok.com/@poisson_stis", 
      icon: "/img/comingsoon/tiktok.png", 
      alt: "TikTok",
      color: "#000000"
    },
    { 
      href: "https://www.youtube.com/@PoissonPolstatSTIS", 
      icon: "/img/comingsoon/youtube.png", 
      alt: "YouTube",
      color: "#FF0000"
    },
    {
    href: "https://mail.google.com/mail/u/0/?view=cm&to=poisson@stis.ac.id",
    icon: "/img/comingsoon/email.png", 
    alt: "Email"
    },
  ];

  const handleCtaClick = (e) => {
    e.preventDefault();
    
    const button = e.currentTarget;
    const rect = button.getBoundingClientRect();
    const ripple = document.createElement('span');
    const size = Math.max(rect.width, rect.height);
    const x = e.clientX - rect.left - size / 2;
    const y = e.clientY - rect.top - size / 2;
    
    ripple.style.cssText = `
      position: absolute;
      width: ${size}px;
      height: ${size}px;
      left: ${x}px;
      top: ${y}px;
      background: rgba(255,255,255,0.4);
      border-radius: 50%;
      transform: scale(0);
      animation: ripple 0.6s ease-out;
      pointer-events: none;
      z-index: 1;
    `;
    
    if (!document.querySelector('#ripple-keyframes')) {
      const style = document.createElement('style');
      style.id = 'ripple-keyframes';
      style.textContent = `
        @keyframes ripple {
          to {
            transform: scale(4);
            opacity: 0;
          }
        }
      `;
      document.head.appendChild(style);
    }
    
    button.appendChild(ripple);
    setTimeout(() => ripple.remove(), 600);
    
    setIsLoading(true);
    setTimeout(() => {
      setIsLoading(false);
      window.open('photobooth', '_blank');
      console.log('Redirecting to photobooth...');
    }, 1200);
  };

  const handleSocialClick = (link, e) => {
    e.preventDefault();
    
  const icon = e.currentTarget.querySelector('img');
    if (icon) {
      icon.style.transform = 'scale(0.8) rotate(-10deg)';
      icon.style.transition = 'all 0.1s ease';
      
      setTimeout(() => {
        icon.style.transform = 'scale(1.1) rotate(5deg)';
        setTimeout(() => {
          icon.style.transform = '';
          window.open(link.href, '_blank', 'noopener,noreferrer');
        }, 100);
      }, 100);
    }
  };

    return (
        <PageContainer>
            <HeaderFlowers src="/img/comingsoon/hiasan-bunga.png" alt="Header Decoration" />
            <BubblesDecoration src="/img/comingsoon/gelembung.png" alt="Bubbles Decoration" />
            <HeaderLine src="/img/comingsoon/header-line.png" alt="Garis Header" />

            <BgLayer3 src="/img/comingsoon/hiasan-bg-3.png" alt="Background Layer 3" />
            <BgLayer2 src="/img/comingsoon/hiasan-bg-2.png" alt="Background Layer 2" />
            
            <HiasanKanan src="/img/comingsoon/hiasan-kanan.png" alt="Right Decoration" />
            <HiasanKiri src="/img/comingsoon/hiasan-kiri.png" alt="Left Decoration" />

            <BgLayer1 src="/img/comingsoon/hiasan-bg-1.png" alt="Background Layer 1" />
            
            <PositioningWrapper>
              <LanguageContainer>
              <LanguageButton onClick={clickDropdown}>
                  <div className="flex items-center space-x-2">
                    <img src={selectedLang === 'en' ? '/img/en.png' : '/img/id.png'} alt="Language Icon" className="w-6 h-4 object-cover" />
                    <span className="text-lg lg:text-[18px] hidden md:block">{selectedLang.toUpperCase()}</span>
                  </div>
                <FontAwesomeIcon icon={isClick ? faChevronUp : faChevronDown} />
              </LanguageButton>
              <AnimatePresence>
                {isClick && (
                  <DropdownMenuContainer
                      variants={dropdownVariants} 
                      initial="closed"          
                      animate="open"             
                      exit="closed"              
                      >
                    <DropdownMenuItem onClick={() => handleLangChange('en')}>
                      <img src="/img/en.png" alt="EN Flag" className="w-6 h-4 object-cover"/>
                      <span>EN</span>
                    </DropdownMenuItem>
                    <DropdownMenuItem onClick={() => handleLangChange('id')}>
                      <img src="/img/id.png" alt="ID Flag" className="w-6 h-4 object-cover"/>
                      <span>ID</span>
                    </DropdownMenuItem>
                  </DropdownMenuContainer>
                            )}
              </AnimatePresence>
            </LanguageContainer>
            
            <ContentCard>
                <ContentWrapper>
                    <TitleContainer>
                        <TextBlock>
                            <TitleLine>
                            <span className="first-letter">C</span>oming
                            </TitleLine>
                            <TitleLine>
                            <span className="first-letter">S</span>oon!
                            </TitleLine>
                        </TextBlock>
                        <LogoImage src="/img/logo-2025-icon.png" alt="Poisson 2025 Logo" />
                    </TitleContainer>
                    <CountdownWrapper>
                      <Subtitle>{t('comingsoon.subtitle')}</Subtitle>
                      <CountdownGrid>
                        {/* DAYS */}
                        <TimeUnitWrapper>
                          <DigitBoxWrapper>
                            {days.split('').map((digit, index) => (
                              <TimeBox key={`day-${index}`}>
                                <TimeValue>{digit}</TimeValue>
                              </TimeBox>
                            ))}
                          </DigitBoxWrapper>
                          <TimeLabel>{t('comingsoon.countdown.days')}</TimeLabel>
                        </TimeUnitWrapper>

                        <Separator>:</Separator>

                        {/* HOURS */}
                        <TimeUnitWrapper>
                          <DigitBoxWrapper>
                            {hours.split('').map((digit, index) => (
                              <TimeBox key={`hour-${index}`}>
                                <TimeValue>{digit}</TimeValue>
                              </TimeBox>
                            ))}
                          </DigitBoxWrapper>
                          <TimeLabel>{t('comingsoon.countdown.hours')}</TimeLabel>
                        </TimeUnitWrapper>

                        <Separator>:</Separator>

                        {/* MINUTES */}
                        <TimeUnitWrapper>
                          <DigitBoxWrapper>
                            {minutes.split('').map((digit, index) => (
                              <TimeBox key={`min-${index}`}>
                                <TimeValue>{digit}</TimeValue>
                              </TimeBox>
                            ))}
                          </DigitBoxWrapper>
                          <TimeLabel>{t('comingsoon.countdown.minutes')}</TimeLabel>
                        </TimeUnitWrapper>

                        <Separator>:</Separator>

                        {/* SECONDS */}
                        <TimeUnitWrapper>
                          <DigitBoxWrapper>
                            {seconds.split('').map((digit, index) => (
                              <TimeBox key={`sec-${index}`}>
                                <TimeValue>{digit}</TimeValue>
                              </TimeBox>
                            ))}
                          </DigitBoxWrapper>
                          <TimeLabel>{t('comingsoon.countdown.seconds')}</TimeLabel>
                        </TimeUnitWrapper>
                      </CountdownGrid>
                    </CountdownWrapper>

                    <TeaserWrapper>
                      <TeaserTitle>{t('comingsoon.teaser.title')}</TeaserTitle>
                      <TeaserContentContainer>
                        <TeaserSubtitleContainer>
                          <TeaserSubtitle>
                            {t('comingsoon.teaser.subtitle')}
                          </TeaserSubtitle>
                        </TeaserSubtitleContainer>
                        <TeaserDecoratedVideoContainer>
                          <StarDecoration src="/img/comingsoon/hiasan-bintang.png" alt="Star Decoration" />
                          <LeftRockDecoration src="/img/comingsoon/batu-kiri.png" alt="Left Rock" />
                          <RightRockDecoration src="/img/comingsoon/batu-kanan.png" alt="Right Rock" />
                          <VideoFrame>
                            <PlantDecoration src="/img/comingsoon/hiasan-bg-video.png" alt="Plant Decoration" />
                            <ResponsiveVideoWrapper>
                              <VideoPlayer
                                src="https://www.youtube.com/embed/8FgUSj0tdD4"
                                title="YouTube video player"
                                frameBorder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowFullScreen
                              />
                            </ResponsiveVideoWrapper>
                          </VideoFrame>
                        </TeaserDecoratedVideoContainer>
                      </TeaserContentContainer>
                    </TeaserWrapper>

                    <CtaWrapper>
                          <CtaTitle>
                            {t('comingsoon.cta.title')}
                          </CtaTitle>
                        <CtaContentWrapper>
                          <CtaSubtitle>
                            {t('comingsoon.cta.subtitle')}
                          </CtaSubtitle>
                        <ButtonWrapper>
                          <CtaButton 
                            href="#" 
                            onClick={handleCtaClick}
                          >
                            {isLoading ? t('comingsoon.cta.loading') : t('comingsoon.cta.button')}
                          </CtaButton>
                        </ButtonWrapper>
                     </CtaContentWrapper>
                    </CtaWrapper>     

                    <FooterWrapper>
                      <SocialLinksContainer>
                        {socialLinks.map((link, index) => (
                          <SocialLink 
                            key={index} 
                            onClick={(e) => handleSocialClick(link, e)}
                          >
                            <SocialIcon src={link.icon} alt={link.alt} />
                          </SocialLink>
                        ))}
                      </SocialLinksContainer>
                    </FooterWrapper>
                </ContentWrapper>
            </ContentCard>
            </PositioningWrapper>
            <FooterLine src="/img/comingsoon/footer-line.png" alt="Footer Line" />
        </PageContainer>
    );
};

export default HeroComing;