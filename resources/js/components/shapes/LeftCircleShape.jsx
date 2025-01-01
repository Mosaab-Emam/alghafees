import React from "react";

const LeftCircleShape = ({ position }) => {
	return (
		<div className={`absolute ${position} `}>
			<svg
				xmlns='http://www.w3.org/2000/svg'
				width='68'
				height='133'
				viewBox='0 0 68 133'
				fill='none'>
				<mask
					id='mask0_664_6056'
					maskUnits='userSpaceOnUse'
					x='0'
					y='0'
					width='68'
					height='133'>
					<rect width='68' height='133' fill='#D9D9D9' />
				</mask>
				<g mask='url(#mask0_664_6056)'>
					<circle
						cx='65.8022'
						cy='65.8022'
						r='50.3022'
						transform='matrix(-0.604901 0.796301 0.796301 0.604901 -10.3906 -25)'
						fill='#FEFFFF'
						stroke='url(#paint0_linear_664_6056)'
						strokeWidth='31'
					/>
				</g>
				<defs>
					<linearGradient
						id='paint0_linear_664_6056'
						x1='65.8022'
						y1='0'
						x2='65.8022'
						y2='131.604'
						gradientUnits='userSpaceOnUse'>
						<stop stopColor='white' stopOpacity='0' />
						<stop offset='1' stopColor='#0F819F' stopOpacity='0.26' />
					</linearGradient>
				</defs>
			</svg>
		</div>
	);
};

export default LeftCircleShape;
