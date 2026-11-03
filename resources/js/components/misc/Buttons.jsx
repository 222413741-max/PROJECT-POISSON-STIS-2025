import tw, { styled } from "twin.macro";

export const PrimaryButton = styled.button`
    ${tw`
    w-40 h-9
    font-bold rounded-[35px]
    bg-gradient-to-br from-orange-200 via-orange-200 to-emerald-300
    text-[#5E8B9A]
    border-2 border-white/50
    focus:outline-none
    transition duration-300
    flex items-center justify-center
  `}
    box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.45);

    &:hover {
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.5);
        transform: scale(1.03);
    }
`;
