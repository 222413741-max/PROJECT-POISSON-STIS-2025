import styled from "styled-components";
import tw from "twin.macro";

export const SectionHeading = styled.h2(({ bottomLine = false })=>[
    bottomLine && tw`
        after:[content: '']
        after:block
        after:w-[70%]
        after:h-[2px]
        after:bg-purple
        after:absolute
        after:bottom-0
        after:left-1/2
        after:-translate-x-1/2
        after:transform`,
    tw`text-4xl sm:text-5xl font-normal tracking-normal text-center bg-clip-text text-transparent bg-gradient-to-r from-orange to-purple uppercase`
])
export const Subheading = tw.h5`font-light tracking-wide text-white italic`
