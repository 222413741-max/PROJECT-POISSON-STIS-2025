import * as React from "react";
const SvgDecorGradientRight = (props) => (
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="1em"
        height="1em"
        fill="none"
        viewBox="0 0 312 950"
        {...props}
    >
        <path fill="url(#decor-gradient-right_svg__a)" d="M0 0h1052v950H0z" />
        <defs>
            <radialGradient
                id="decor-gradient-right_svg__a"
                cx={0}
                cy={0}
                r={1}
                gradientTransform="rotate(89.88 25 501.053)scale(475.001 475.208)"
                gradientUnits="userSpaceOnUse"
            >
                <stop stopColor="#ffff" stopOpacity={0} />
                <stop offset={1} stopColor="#ffff" stopOpacity={0} />
            </radialGradient>
        </defs>
    </svg>
);
export default SvgDecorGradientRight;
