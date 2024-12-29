import React, { useEffect } from "react";
import { OurPartners, PageTopSection } from "../../components";
import ClientsBoxOne from "./ClientsBoxOne";
import OurClientsSlider from "./ourClientsSlider/OurClientsSlider";
import ClientsBoxTwo from "./ourClientsSlider/ClientsBoxTwo";

const OurClients = () => {
	useEffect(() => {
		window.scrollTo(0, 0);
	}, []);
	return (
		<>
			<PageTopSection title={"عملاؤنا"} description={"ثقة عملائنا"} />
			<section className='container md:mt-[211px] mt-[6rem]'>
				<ClientsBoxOne />
				<OurClientsSlider />
				<ClientsBoxTwo />
			</section>
			<OurPartners className='pt-8 pb-12' />
		</>
	);
};

export default OurClients;
