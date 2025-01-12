import React from "react";

const OurClientsShape = ({ position }) => {
	return (
		<div className={`absolute ${position}`}>
			<svg
				xmlns='http://www.w3.org/2000/svg'
				width='152'
				height='253'
				viewBox='0 0 152 253'
				fill='none'>
				<mask
					id='mask0_682_21333'
					maskUnits='userSpaceOnUse'
					x='0'
					y='0'
					width='152'
					height='253'>
					<rect width='152' height='253' fill='#D9D9D9' />
				</mask>
				<g mask='url(#mask0_682_21333)'>
					<circle
						cx='126.597'
						cy='125.595'
						r='110.531'
						transform='rotate(52.7783 126.597 125.595)'
						fill='#FEFFFF'
						stroke='url(#paint0_linear_682_21333)'
						strokeWidth='31'
					/>
				</g>
				<defs>
					<linearGradient
						id='paint0_linear_682_21333'
						x1='126.597'
						y1='-0.436234'
						x2='126.597'
						y2='251.625'
						gradientUnits='userSpaceOnUse'>
						<stop stopColor='white' stopOpacity='0' />
						<stop offset='1' stopColor='#0F819F' stopOpacity='0.26' />
					</linearGradient>
				</defs>
			</svg>
		</div>
	);
};

export default OurClientsShape;
