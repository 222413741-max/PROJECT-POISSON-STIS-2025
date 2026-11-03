import styled from "styled-components";
import tw from "twin.macro";

// Define SectionHeading with styled-components and twin.macro
export const SectionHeading = styled.h2(({ bottomLine = false }) => [
    bottomLine && tw`relative`, // Make sure the parent is positioned relatively
    tw`text-4xl sm:text-5xl font-normal tracking-normal text-center bg-clip-text text-transparent bg-gradient-to-r from-orange-500 to-purple-500 uppercase`,
    bottomLine &&
        `
    &::after {
      content: '';
      ${tw`block w-[70%] h-[2px] bg-purple-500 absolute bottom-0 left-1/2 transform -translate-x-1/2`}
    }
  `,
]);

// Define Subheading with twin.macro
export const Subheading = tw.h5`font-light tracking-wide text-white italic`;
