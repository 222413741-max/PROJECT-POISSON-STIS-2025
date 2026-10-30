import React, { useState, useContext } from "react";
import { motion } from "framer-motion";
import styled from "styled-components";
import tw from "twin.macro";
import * as Icon from "react-feather";
import { useTranslation } from "react-i18next";
import { faqBg, transisiFAQBottom, transisiFAQTop } from "../config";

import Context from "../helpers/Context";
import { SectionHeading } from "./misc/Headings";
import { SectionDescription } from "./misc/Typography";
import { Container, ContentWithPaddingXl } from "./misc/Layouts";

// import { ReactComponent as ChevronDownIcon } from "feather-icons/dist/icons/chevron-down.svg";
// import { ReactComponent as SvgDecoratorWaterDrop } from "images/decor-faqs-waterdrop.svg";

const ChevronDownIcon = Icon.ChevronDown;

// Styled Component
const Heading = styled(SectionHeading)`
    ${tw`bg-clip-text text-white font-bold font-playfair mt-10 text-9xl`}
    text-shadow: 0px 8px 10px rgba(0, 0, 0, 1);
`;

const Description = styled(SectionDescription)`
    ${tw`relative w-full leading-[65px] font-lato font-bold text-2xl md:text-4xl text-white italic text-center lg:text-left`}
    text-shadow: 0px 10px 15px rgba(0, 0, 0, 0.55);
`;

const LayoutFAQ = tw.div`flex flex-col lg:flex-row items-center lg:items-start justify-between relative overflow-visible`;

const FAQSContainer = tw.dl`relative mt-12 max-w-4xl z-20 h-[140vh] md:h-[100vh] lg:h-[100vh] lg:pr-4`;

const HeaderContainer = tw.div`flex flex-col items-center lg:items-start lg:mr-16 sticky top-[6rem]`;

const FAQ = tw.div`cursor-pointer select-none mt-5 px-8 sm:px-10 py-5 sm:py-4 rounded-lg hover:text-secondaryPoi25-300 bg-primaryPoi25-900 transition duration-300`;

const Question = tw.dt`flex gap-5 items-center`;

const QuestionText = tw.span`text-base md:text-xl font-semibold text-secondaryPoi25-100 text-left italic`;

const QuestionToggleIcon = motion(styled.span`
    ${tw`ml-2 transition duration-300`}
    svg {
        ${tw`w-6 h-6`}
    }
`);

const Answer = motion(
    tw.dd`pointer-events-none text-sm sm:text-base leading-relaxed text-white`
);

const BackgroundContainer = styled.div((props) => [
    `background-image: url("${props.imageSrc}");
  background-position: top center;
  background-size: cover;
  background-repeat: no-repeat;`,
    tw`absolute inset-0 w-full h-full`,
]);

const LayerTop = styled.div`
    position: absolute;

    background-image: url("/img/landing-page/landing/layerTopFAQ.svg");
    background-size: contain;
    background-repeat: no-repeat;
    background-position: top center;

    width: 100%;
    height: 800px;
    z-index: 0;
`;

const LayerBottom = styled.div`
    position: absolute;
    bottom: 0;

    background-image: url("/img/landing-page/landing/layerBottomFAQ.svg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: bottom center;

    width: 100%;
    height: 100vh;
    z-index: 0;

    @media (max-width: 640px) {
        background-size: contain;
    }
    @media (min-width: 641px) and (max-width: 1024px) {
        background-size: contain;
    }
`;

const Transisi = styled.div`
    ${tw`absolute left-0 right-0 w-full z-20 pointer-events-none`}
    height: ${(props) => props.height || "200px"};
    background-size: cover;
    background-repeat: no-repeat;
    ${({ position }) => position === "top" && tw`top-0`}
    ${({ position }) => position === "bottom" && tw`bottom-0`}
  background-image: ${({ img }) => `url(${img})`};
`;

// Component
const FAQComponent = () => {
    const { faqs } = useContext(Context);
    const [activeQuestionIndex, setActiveQuestionIndex] = useState(null);

    const toggleQuestion = (questionIndex) => {
        if (activeQuestionIndex === questionIndex) setActiveQuestionIndex(null);
        else setActiveQuestionIndex(questionIndex);
    };

    const { t } = useTranslation();
    var num;

    return (
        <Container id="faq">
            <BackgroundContainer imageSrc={faqBg} />
            <Transisi position="top" img={transisiFAQTop} />
            <LayerTop />
            <LayerBottom />
            <ContentWithPaddingXl>
                <LayoutFAQ>
                    <HeaderContainer>
                        <Heading bottomLine={true}>FAQ</Heading>
                        <Description>{t("faq.description")}</Description>
                    </HeaderContainer>
                    <FAQSContainer>
                        {faqs.map(
                            (faq, index) => (
                                (num = index + 1),
                                (
                                    <FAQ
                                        key={index}
                                        onClick={() => {
                                            toggleQuestion(index);
                                        }}
                                        className="group"
                                    >
                                        <Question>
                                            {/* <QuestionText>{faq.question}</QuestionText> */}
                                            <QuestionToggleIcon
                                                variants={{
                                                    collapsed: { rotate: 0 },
                                                    open: { rotate: -180 },
                                                }}
                                                initial="collapsed"
                                                animate={
                                                    activeQuestionIndex ===
                                                    index
                                                        ? "open"
                                                        : "collapsed"
                                                }
                                                transition={{
                                                    duration: 0.02,
                                                    ease: [
                                                        0.04, 0.62, 0.23, 0.98,
                                                    ],
                                                }}
                                            >
                                                <ChevronDownIcon />
                                            </QuestionToggleIcon>
                                            <QuestionText>
                                                {t("faq-quest." + num)}
                                            </QuestionText>
                                        </Question>
                                        <Answer
                                            variants={{
                                                open: {
                                                    opacity: 1,
                                                    height: "auto",
                                                    marginTop: "16px",
                                                },
                                                collapsed: {
                                                    opacity: 0,
                                                    height: 0,
                                                    marginTop: "0px",
                                                },
                                            }}
                                            initial="collapsed"
                                            animate={
                                                activeQuestionIndex === index
                                                    ? "open"
                                                    : "collapsed"
                                            }
                                            transition={{
                                                duration: 0.3,
                                                ease: [0.04, 0.62, 0.23, 0.98],
                                            }}
                                        >
                                            {/* {faq.answer} */}
                                            {t("faq-ans." + num)}
                                        </Answer>
                                    </FAQ>
                                )
                            )
                        )}
                    </FAQSContainer>
                </LayoutFAQ>
            </ContentWithPaddingXl>
            <Transisi position="bottom" img={transisiFAQBottom} />
        </Container>
    );
};

export default FAQComponent;
