import React, { useState, useContext } from "react";
import { motion } from "framer-motion";
import styled from "styled-components";
import tw from "twin.macro";
import * as Icon from "react-feather";

import Context from "../helpers/Context";
import { SectionHeading } from "./misc/Headings";
import { SectionDescription } from "./misc/Typography";
import { Container, ContentWithPaddingXl } from "./misc/Layouts";

// import { ReactComponent as ChevronDownIcon } from "feather-icons/dist/icons/chevron-down.svg";
// import { ReactComponent as SvgDecoratorWaterDrop } from "images/decor-faqs-waterdrop.svg";
import SvgDecorFaqsWaterdrop from "./svgJSX/DecorFaqsWaterdrop";

const ChevronDownIcon = Icon.ChevronDown;
const SvgDecoratorWaterDrop = SvgDecorFaqsWaterdrop;

// Styled Component
const Heading = tw(SectionHeading)`relative inline-block`;

const Description = tw(SectionDescription)`w-full text-center`;

const Column = tw.div`flex flex-col items-center`;

const FAQSContainer = tw.dl`mt-12 max-w-4xl relative z-20`;

const FAQ = tw.div`cursor-pointer select-none mt-5 px-8 sm:px-10 py-5 sm:py-4 rounded-lg text-white hover:text-gray-900 bg-[#44347A] hover:bg-orange transition duration-300`;

const Question = tw.dt`flex justify-between items-center`

const QuestionText = tw.span`text-lg lg:text-xl font-semibold`;

const QuestionToggleIcon = motion(styled.span`
  ${tw`ml-2 transition duration-300`}
  svg {
    ${tw`w-6 h-6`}
  }
`);

const Answer = motion(
  tw.dd`pointer-events-none text-sm sm:text-base leading-relaxed`
);

const DecoratorWaterDrop = styled(SvgDecoratorWaterDrop)`
  ${tw`pointer-events-none z-0 absolute left-0 top-0  w-56 h-56 md:w-96 md:h-96 transform translate-x-[-4rem] -translate-y-12 text-blue-600`}
`;

// Component
const FAQComponent = () => {
  const { faqs } = useContext(Context);
  const [activeQuestionIndex, setActiveQuestionIndex] = useState(null);

  const toggleQuestion = (questionIndex) => {
    if (activeQuestionIndex === questionIndex) setActiveQuestionIndex(null);
    else setActiveQuestionIndex(questionIndex);
  };

  return (
    <Container id="faq">
      <ContentWithPaddingXl>
        <Column>
          <div>
            <Heading bottomLine={true}>
              FAQS
            </Heading>
            <Description>
              {/* And we have got answers to all of them. Lorem ipsum dolor sit
              amet, consectetur adipiscing elit. */}
            </Description>
          </div>
          <FAQSContainer>
            {faqs.map((faq, index) => (
              <FAQ
                key={index}
                onClick={() => {
                  toggleQuestion(index);
                }}
                className="group"
              >
                <Question>
                  <QuestionText>{faq.question}</QuestionText>
                  <QuestionToggleIcon
                    variants={{
                      collapsed: { rotate: 0 },
                      open: { rotate: -180 },
                    }}
                    initial="collapsed"
                    animate={
                      activeQuestionIndex === index ? "open" : "collapsed"
                    }
                    transition={{
                      duration: 0.02,
                      ease: [0.04, 0.62, 0.23, 0.98],
                    }}
                  >
                    <ChevronDownIcon />
                  </QuestionToggleIcon>
                </Question>
                <Answer
                  variants={{
                    open: { opacity: 1, height: "auto", marginTop: "16px" },
                    collapsed: { opacity: 0, height: 0, marginTop: "0px" },
                  }}
                  initial="collapsed"
                  animate={activeQuestionIndex === index ? "open" : "collapsed"}
                  transition={{ duration: 0.3, ease: [0.04, 0.62, 0.23, 0.98] }}
                >
                  {faq.answer}
                </Answer>
              </FAQ>
            ))}
          </FAQSContainer>
        </Column>
      </ContentWithPaddingXl>
      <DecoratorWaterDrop />
    </Container>
  );
};

export default FAQComponent;
