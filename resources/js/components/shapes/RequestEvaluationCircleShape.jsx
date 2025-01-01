import React from "react";

const RequestEvaluationCircleShape = ({ position }) => {
	return (
		<div className={`absolute ${position} `}>
			<svg
				xmlns='http://www.w3.org/2000/svg'
				width='161'
				height='252'
				viewBox='0 0 161 252'
				fill='none'>
				<mask
					id='mask0_682_21374'
					maskUnits='userSpaceOnUse'
					x='0'
					y='0'
					width='161'
					height='252'>
					<rect width='161' height='252' fill='#D9D9D9' />
				</mask>
				<g mask='url(#mask0_682_21374)'>
					<circle
						cx='126.031'
						cy='126.031'
						r='110.531'
						transform='matrix(-0.604901 0.796301 0.796301 0.604901 9.47266 -50)'
						fill='#FEFFFF'
						stroke='url(#paint0_linear_682_21374)'
						strokeWidth='31'
					/>
				</g>
				<defs>
					<linearGradient
						id='paint0_linear_682_21374'
						x1='126.031'
						y1='0'
						x2='126.031'
						y2='252.062'
						gradientUnits='userSpaceOnUse'>
						<stop stopColor='white' stopOpacity='0' />
						<stop offset='1' stopColor='#0F819F' stopOpacity='0.26' />
					</linearGradient>
				</defs>
			</svg>
		</div>
	);
};

export default RequestEvaluationCircleShape;
