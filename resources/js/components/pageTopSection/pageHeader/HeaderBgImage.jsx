import React from "react";

const HeaderBgImage = () => {
    return (
        <div className="md:w-[1415px] w-[360px] md:h-[400px] h-[240px] absolute top-0 right-0 z-[1]">
            <svg
                className="md:block hidden"
                xmlns="http://www.w3.org/2000/svg"
                width="5680"
                height="413"
                viewBox="-4250 0 5680 413"
                fill="none"
            >
                <path
                    d="M1416 0.499752L1416 400.5L-4246.4 400.5"
                    stroke="url(#paint0_linear_153_14492)"
                    strokeWidth="25"
                />
                <defs>
                    <linearGradient
                        id="paint0_linear_153_14492"
                        x1="-7.50003"
                        y1="410"
                        x2="1431"
                        y2="12.0001"
                        gradientUnits="userSpaceOnUse"
                    >
                        <stop stopColor="#808282" />
                        <stop offset="1" stopColor="#0F819F" />
                    </linearGradient>
                </defs>
            </svg>

            <svg
                className="md:hidden block"
                xmlns="http://www.w3.org/2000/svg"
                width="360"
                height="244"
                viewBox="0 0 360 244"
                fill="none"
            >
                <path
                    d="M360 -6.29444e-05L360 240L4.19629e-05 240"
                    stroke="url(#paint0_linear_604_5259)"
                    strokeWidth="6.35768"
                />
                <defs>
                    <linearGradient
                        id="paint0_linear_604_5259"
                        x1="-2.00663"
                        y1="245.7"
                        x2="386.476"
                        y2="200.143"
                        gradientUnits="userSpaceOnUse"
                    >
                        <stop stopColor="#808282" />
                        <stop offset="1" stopColor="#0F819F" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
    );
};

export default HeaderBgImage;
