import React, { useContext, useEffect, useRef, useState } from 'react'
import tw from 'twin.macro'
import styled from 'styled-components'
import Context from '../helpers/Context'
import { useTranslation } from 'react-i18next'

import { SectionHeading, Subheading } from './misc/Headings'
import {
  Container as ContainerBase,
  ContentWithPaddingXl,
} from './misc/Layouts'
import { SectionDescription } from './misc/Typography'
import { PrimaryButton } from './misc/Buttons'

import SvgWriterNewsIcon from './svgJSX/WriterNewsIcon'
import SvgDateNewsIcon from './svgJSX/DateNewsIcon'
import SvgChevNext from './svgJSX/ChevNext'
import SvgChevPrev from './svgJSX/ChevPrev'

const WriterIcon = SvgWriterNewsIcon
const DateIcon = SvgDateNewsIcon
const SvgChevronNext = SvgChevNext
const SvgChevronPrev = SvgChevPrev

// import CloseIcon } from "feather-icons/dist/icons/x.svg";
import * as Icon from 'react-feather'
const CloseIcon = Icon.X

// styled main component

const Container = styled(ContainerBase)`relative border border-white`

const CardColumn = tw.div` overflow-clip max-w-full `

const ColumnTranslateAble = tw.div`flex flex-row pl-10 gap-x-10 py-2 transition duration-500`

const HeadingWrapper = tw.div`w-full text-center`

const Heading = tw(
  SectionHeading,
)`underline mb-20 tracking-wide uppercase relative inline-block bg-gradient-to-r from-green-700 to-green-600 bg-clip-text text-transparent font-bold font-serif mt-10`

const BtnSwipeWrapper = tw.div`flex justify-center gap-4`

const BtnSwiper = tw.span`flex items-center justify-center w-10 h-10 px-1 bg-[#ffff] rounded-full cursor-pointer z-0`

// styled modal
const BackDrop = tw.div`fixed top-0 left-0 right-0 z-10 p-4 overflow-hidden md:inset-0 h-full bg-gray-900 bg-opacity-50`

const ModalWrapper = tw.div`flex w-full justify-center items-center z-20`

const Modal = tw.div`relative top-0 left-0 inset-0 bg-white rounded-md lg:w-[70vw] rounded-2xl overflow-hidden z-20`

const ModalHead = tw.div`flex justify-between items-center px-5 py-3 text-black`

const TitleNews = tw.p`text-black text-sm font-semibold tracking-wider`

const ModalBody = tw.div`px-10 w-full h-[80vh] overflow-y-scroll`

const ButtonClose = tw.div`cursor-pointer block w-[25px] h-[25px]  hover:rounded-full hover:bg-purple-500 hover:text-black transition-all duration-300 flex justify-center items-center`

const ThumbWrapper = tw.div`flex justify-center`

const Thumbnail = tw.img`object-cover object-center lg:w-[700px]`

const TextWrapper = tw.div`mt-4 w-full`

const Text = tw.p`text-xs md:text-base font-medium leading-relaxed text-black`

const ModalFooter = tw.footer`flex justify-start items-center gap-3 py-2 px-4 bg-[#fff]`

// styled card component
const CardOuter = tw.div`min-w-[100%] md:min-w-[50%] lg:min-w-[30%] overflow-hidden cursor-pointer rounded-2xl z-0`

const Card = tw.div`flex flex-col max-h-full`

const TopSectionWrapper = tw.div`relative max-w-full overflow-hidden `

const Image = tw.img`object-cover object-center transition-all duration-300 `

const FloatingDate = tw.div`absolute top-[10px] right-[10px] p-2 flex flex-col items-center w-[50px] h-[50px] rounded-full bg-[#fff] text-black leading-tight`

const SpanDateBase = tw.span`inline text-base tracking-wide text-center`

const SpanDateXs = tw.span`inline text-xs tracking-wide text-center`

const BottomSectionContent = tw.div`block px-3 py-2 bg-[#fff] rounded-b-2xl transition-all duration-300`

const Title = tw(Subheading)`w-full block my-2 text-black`

const SlugParagraph = tw(
  SectionDescription,
)`text-xs tracking-wide leading-normal text-black transition duration-300 overflow-hidden`

const BtnDetail = tw(
  PrimaryButton,
)`block tracking-wide my-4 py-1 px-4 text-xs font-normal`

const Footer = tw.div`flex justify-start items-center gap-3 py-2`

const SectionIcon = tw.div`flex justify-start items-center gap-x-1 max-w-full`

const SectionText = tw.p`text-black text-xs pt-1`

const SvgWriterIcon = styled(WriterIcon)`
  ${tw`h-4 w-4`}
`
const SvgDateIcon = styled(DateIcon)`
  ${tw`h-4 w-4`}
`
const MessageNoNews = tw.div`px-2 py-3 rounded-md bg-[#ffff] mx-auto text-center text-black text-xl tracking-wide z-10 font-bold`

// component modal
const ModalDetail = ({ isShow, onModalChange, spesificNews }) => {
  const [showModal, setShowModal] = useState(isShow)

  const modalRef = useRef(null)

  const toggleModal = () => {
    setShowModal(!showModal)
    onModalChange.setOpenModal(!showModal)
  }

  useEffect(() => {
    const clickAwayModal = (event) => {
      if (
        (modalRef.current && !modalRef.current.contains(event.target)) ||
        event.target.id === 'closeBtn'
      ) {
        setShowModal(!showModal)
        onModalChange.setOpenModal(!showModal)
        onModalChange.setIdCard(spesificNews.id)
      }
    }
    document.addEventListener('mousedown', clickAwayModal)

    // Prevent scrolling when the modal is opened
    // Ngebug dia gak bisa scroll pas diclose
    // if (showModal) {
    //   document.body.style.overflow = 'hidden'
    // } else {
    //   document.body.style.overflow = 'scroll'
    // }

    return () => {
      document.removeEventListener('mousedown', clickAwayModal)
    }
  }, [
    isShow,
    onModalChange,
    onModalChange.setOpenModal,
    showModal,
    spesificNews,
  ])

  // useEffect(() => {
  //   // allow scrolling when the modal is closed
  //   if (showModal) {
  //     document.body.style.overflow = 'hidden'
  //   } else {
  //     document.body.style.overflow = 'auto'
  //   }
  // }, [showModal])
  const { t } = useTranslation();

  return (
    showModal && (
      <BackDrop>
        <ModalWrapper>
          <Modal ref={modalRef}>
            <ModalHead>
              <TitleNews>{t('news-title.' + spesificNews.id)}</TitleNews>
              <ButtonClose onClick={toggleModal}>
                <CloseIcon
                  id="closeBtn"
                  onClick={(event)=> {
                    event.stopPropagation()
                  }}
                />
              </ButtonClose>
            </ModalHead>
            <ModalBody>
              <ThumbWrapper>
                <Thumbnail src={spesificNews.thumbnail} />
              </ThumbWrapper>
              <TextWrapper>
                <Text>{t('news-desc.' + spesificNews.id)}</Text>
              </TextWrapper>
            </ModalBody>
            <ModalFooter>
              <SectionIcon>
                <SvgDateIcon />
                <SectionText>{t('news-date.' + spesificNews.id)}</SectionText>
              </SectionIcon>
              <SectionIcon>
                <SvgWriterIcon />
                <SectionText>{spesificNews.author}</SectionText>
              </SectionIcon>
            </ModalFooter>
          </Modal>
        </ModalWrapper>
      </BackDrop>
    )
  )
}

const CardNews = ({ content, onModalChange }) => {
  const [isHovered, setIsHovered] = useState(false)

  const presetTarget = (id) => {
    onModalChange.handlePassedId(id)
    onModalChange.setOpenModal(true)
  }

  const { t } = useTranslation();

  return (
    <CardOuter
      onMouseEnter={() => setIsHovered(true)}
      onMouseLeave={() => setIsHovered(false)}
      onClick={() => {
        presetTarget(content.id)
      }}
    >
      <Card>
        <TopSectionWrapper>
          <Image
            src={content.thumbnail}
            style={{
              width: '100%',
              filter: isHovered ? 'brightness(70%)' : 'brightness(100%)',
            }}
          />
          <FloatingDate>
            <SpanDateBase>{t('news-date.' + content.id).split(' ')[0]}</SpanDateBase>
            <SpanDateXs>{t('news-date.' + content.id).split(' ')[1]}</SpanDateXs>
          </FloatingDate>
        </TopSectionWrapper>
        <BottomSectionContent>
          <Title>{t('news-title.' + content.id)}</Title>
          <SlugParagraph>{t('news-desc.' + content.id).substring(0, 250)} ...</SlugParagraph>
          <BtnDetail onClick={() => presetTarget(content.id)}>
            {t('selengkapnya')}
          </BtnDetail>
          <Footer className="px-4">
            <SectionIcon>
              <SvgDateIcon />
              <SectionText>{t('news-date.' + content.id)}</SectionText>
            </SectionIcon>
            <SectionIcon>
              <SvgWriterIcon />
              <SectionText>{content.author}</SectionText>
            </SectionIcon>
          </Footer>
        </BottomSectionContent>
      </Card>
    </CardOuter>
  )
}

const Berita = () => {
  const { news } = useContext(Context)
  const [activeIndex, setActiveIndex] = useState(0)
  const [transformPoint, setTransformPoint] = useState(30)
  const [idCard, setIdCard] = useState(null)
  const [openModal, setOpenModal] = useState(false)

  // preset transform based screen width
  const handleTransfrom = () => {
    const screenWidth = window.innerWidth
    if (screenWidth < 768) setTransformPoint(100)
    else if (screenWidth < 1024) setTransformPoint(50)
    else setTransformPoint(30)
  }

  const swipe = ({ isNext = false }) => {
    handleTransfrom()
    if (isNext) setActiveIndex(activeIndex + 1)
    else setActiveIndex(activeIndex - 1)
  }

  const checkLoop = (index, max) => {
    if (max === 0) return
    if (index < 0) {
      setActiveIndex(max)
      return max
    }
    if (index >= max) {
      setActiveIndex(0)
      return 0
    }
    return index
  }

  const looped = checkLoop(activeIndex, news.length)

  const handlePassedId = (id = null) => {
    if (id) setIdCard(id)
    return
  }
  const { t } = useTranslation()
  return (
    <Container id="berita">
      <ContentWithPaddingXl>
        <HeadingWrapper>
          <Heading bottomLine={true}>{t('section-title.berita')}</Heading>
        </HeadingWrapper>
        <CardColumn>
          <ColumnTranslateAble
            style={{
              transform: `translate(-${looped * transformPoint}vw)`,
            }}
          >
            {news.length > 0 ? (
              news.map((berita, index) => (
                <CardNews
                  key={index}
                  content={berita}
                  onModalChange={{
                    setOpenModal,
                    handlePassedId,
                  }}
                />
              ))
            ) : (
              <MessageNoNews>{t('news.unavailable')}</MessageNoNews>
            )}
          </ColumnTranslateAble>
          {openModal && (
            <ModalDetail
              isShow={openModal}
              spesificNews={news[idCard - 1]}
              onModalChange={{ setOpenModal, setIdCard }}
            />
          )}
        </CardColumn>
        {news.length > 0 && (
          <BtnSwipeWrapper>
            <BtnSwiper onClick={() => swipe({ isNest: false })}>
              <SvgChevronPrev stroke="#000" />
            </BtnSwiper>
            <BtnSwiper onClick={() => swipe({ isNext: true })}>
              <SvgChevronNext stroke="#000" />
            </BtnSwiper>
          </BtnSwipeWrapper>
        )}
      </ContentWithPaddingXl>
    </Container>
  )
}

export default Berita
