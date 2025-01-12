import React from "react";

import "./OurPartners.css";
import { ourPartnersData } from "../../data";

const OurPartners = ({ className = "pt-10 pb-60" }) => {
	return (
		<section
			className={`${className} md:w-[1480px] w-full md:pt-24 md:pb-24 overflow-hidden`}>
			<div className='relative infinite-scroll-container'>
				<div className='flex animate-infinite-scroll'>
					{[
						...ourPartnersData,
						...ourPartnersData,
						...ourPartnersData,
						...ourPartnersData,
					].map((partner, index) => (
						<div
							key={index}
							className='md:min-w-40 min-w-[50px] h-20 md:mx-8 mx-4 '>
							<img
								loading='lazy'
								className='h-full w-full object-scale-down '
								src={partner.image}
								alt={`Partner ${index + 1}`}
							/>
						</div>
					))}
				</div>
			</div>
		</section>
	);
};

export default OurPartners;
