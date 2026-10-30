import React, { useContext, useState, useRef, useEffect } from "react";
import tw from "twin.macro";
import Context from "../helpers/Context";

import { SectionHeading } from "./misc/Headings";
import { Container, ContentWithPaddingXl } from "./misc/Layouts";

// import { ReactComponent as SvgChevronNext } from "../images/chev-next.svg";
// import { ReactComponent as SvgChevronPrev } from "../images/chev-prev.svg";
import SvgChevNext from "./svgJSX/ChevNext";
import SvgChevPrev from "./svgJSX/ChevPrev";

const SvgChevronNext = SvgChevNext;
const SvgChevronPrev = SvgChevPrev;

// styled swiper card
const Swiper = tw.div`flex sm:flex-row flex-col justify-center w-full gap-2 py-3 mt-4`;

const SwiperBtnContainer = tw.div`hidden sm:flex items-center`;

const SwiperBtn = tw.div`w-10 h-10 p-2 bg-[#44347A] opacity-[80%] hover:opacity-100 cursor-pointer rounded-full text-white`;

const SwiperBtnContainerSm = tw.div`flex sm:hidden gap-4 justify-center `;

const SwiperImagesContainer = tw.div`w-[300px] md:w-[500px] lg:w-[700px] overflow-hidden rounded-md`;

const ContainerTranslateAble = tw.div`flex  w-[300px] md:w-[500px] lg:w-[700px] transition duration-500 ease-in-out`;

const Img = tw.img`object-contain object-center w-[300px] md:w-[500px] lg:w-[700px]`;

const CardSwiper = (props) => {
    const [activeIndex, setActiveIndex] = useState(0);

    const swipe = ({ isNext }) => {
        if (isNext) setActiveIndex(activeIndex + 1);
        else setActiveIndex(activeIndex - 1);
    };

    const loopIndex = (index, max) => {
        if (index < 0) {
            setActiveIndex(max);
            return max;
        }
        if (index >= max) {
            setActiveIndex(0);
            return 0;
        }
        return index;
    };

    const loopedIndex = loopIndex(activeIndex, props.items.length);

    return (
        <Swiper>
            <SwiperBtnContainer>
                <SwiperBtn onClick={() => swipe({ isNext: false })}>
                    <SvgChevronPrev />
                </SwiperBtn>
            </SwiperBtnContainer>
            <SwiperImagesContainer>
                <ContainerTranslateAble
                    style={{
                        transform: `translate(-${loopedIndex * 100}%)`,
                    }}
                >
                    {props.items.map((item, index) => (
                        <Img
                            key={index}
                            src={item.src}
                            style={{
                                order:
                                    props.itemSelected === index ? 1 : "unset",
                            }}
                        />
                    ))}
                </ContainerTranslateAble>
            </SwiperImagesContainer>
            <SwiperBtnContainer>
                <SwiperBtn onClick={() => swipe({ isNext: true })}>
                    <SvgChevronNext />
                </SwiperBtn>
            </SwiperBtnContainer>

            {/* button for small screen */}
            <SwiperBtnContainerSm>
                <SwiperBtn onClick={() => swipe({ isNext: false })}>
                    <SvgChevronPrev />
                </SwiperBtn>
                <SwiperBtn onClick={() => swipe({ isNext: true })}>
                    <SvgChevronNext />
                </SwiperBtn>
            </SwiperBtnContainerSm>
        </Swiper>
    );
};

// styled galeri card
const Wrapper = tw.div`block rounded-2xl overflow-hidden cursor-pointer transition duration-500 `;

const ImageWrapper = tw.div`md:h-[150px] lg:h-[250px] overflow-hidden relative transition duration-300`;

const Image = tw.img`object-cover object-top`;

const DescWrapper = tw.div`absolute bottom-0 left-0 flex items-center justify-center bg-[#44347A] py-4 text-center w-full opacity-[80%] transition-all duration-300 ease-in`;

const Description = tw.span`text-white`;

// styled modal card
const BackDrop = tw.div`fixed top-0 left-0 right-0 z-20 w-full p-4 overflow-hidden md:inset-0 h-full bg-gray-900 bg-opacity-50`;

const Modal = tw.div`absolute top-0 left-0 w-full flex justify-center z-30`;

const ModalWrapper = tw.div`relative mt-4 bg-primary max-w-full lg:w-[90vw] max-h-full rounded-2xl overflow-hidden`;

const ModalHead = tw.div`flex justify-between bg-[#44347A] items-center px-5 py-3 text-white`;

const Title = tw.p`text-xl font-semibold tracking-wider`;

const ButtonClose = tw.div`cursor-pointer block w-[25px] h-[25px]  hover:rounded-full hover:bg-primary hover:text-white transition-all duration-300 flex justify-center items-center`;

const Body = tw.div`px-2 py-4 flex items-center`;

const CardGaleri = ({ title, imageLink, images, index }) => {
    const [isShow, setIsShow] = useState(false);

    const [isHovered, setIsHovered] = useState(false);

    const modalRef = useRef(null);

    const togleModal = () => {
        setIsShow(!isShow);
    };

    useEffect(() => {
        const clickAwayModal = (event) => {
            if (modalRef.current && !modalRef.current.contains(event.target)) {
                setIsShow(!isShow);
            }
        };
        document.addEventListener("mousedown", clickAwayModal);
        // Prevent scrolling when the modal is open
        if (isShow) {
            document.body.style.overflow = "hidden";
        } else {
            document.body.style.overflow = "auto";
        }

        return () => {
            document.removeEventListener("mousedown", clickAwayModal);
        };
    }, [isShow, modalRef]);

    return (
        <>
            <Wrapper
                className="group"
                onMouseEnter={() => {
                    setIsHovered(true);
                }}
                onMouseLeave={() => {
                    setIsHovered(false);
                }}
            >
                <ImageWrapper>
                    <Image src={imageLink}></Image>
                    <DescWrapper
                        style={{
                            height: isHovered ? "100%" : "30px",
                            overflow: "hidden",
                        }}
                        onClick={togleModal}
                    >
                        <Description>{title}</Description>
                    </DescWrapper>
                </ImageWrapper>
            </Wrapper>
            {isShow && (
                <BackDrop showModal={isShow}>
                    <Modal>
                        <ModalWrapper ref={modalRef}>
                            <ModalHead>
                                <Title>Galeri</Title>
                                <ButtonClose onClick={togleModal}>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        strokeWidth={2}
                                        stroke="currentColor"
                                        className="w-6 h-6"
                                    >
                                        <path
                                            strokeLinecap="round"
                                            strokeLinejoin="round"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </ButtonClose>
                            </ModalHead>
                            <Body>
                                <CardSwiper
                                    items={images}
                                    itemSelected={index}
                                />
                            </Body>
                        </ModalWrapper>
                    </Modal>
                </BackDrop>
            )}
        </>
    );
};

// styled component
const GaleriContainer = tw.div`relative grid grid-cols-1 md:grid-cols-3 gap-3 p-5 md:p-10 max-w-full rounded-md`;

const HeadingWrapper = tw.div`w-full text-center mb-10`;

const GaleriHeading = tw(SectionHeading)`relative inline-block`;

const SquareTopLeft = tw.div`absolute top-0 left-0 rounded-2xl w-[80%] h-[80%] border-2 border-purple`;

const SquareBottomRigth = tw.div`absolute bottom-0 right-0 rounded-md w-[80%] h-[80%] border-2 border-orange`;

const Galeri = () => {
    const { galeries } = useContext(Context);

    return (
        <Container id="galeri">
            <ContentWithPaddingXl>
                <HeadingWrapper>
                    <GaleriHeading bottomLine={true}>Galeri</GaleriHeading>
                </HeadingWrapper>
                <GaleriContainer>
                    <SquareTopLeft />
                    <SquareBottomRigth />
                    {galeries.map((galeri, index) => (
                        <CardGaleri
                            key={index}
                            title={galeri.title}
                            imageLink={galeri.src}
                            images={galeries}
                            index={index}
                        />
                    ))}
                </GaleriContainer>
            </ContentWithPaddingXl>
        </Container>
    );
};

export default Galeri;
