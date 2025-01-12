import React from "react";
import { Logo } from "../../assets/icons";

import "./PreLoadingPage.css";

const PreLoadingPage = () => {
	return (
		<div className='fixed loading inset-0 bg-bg-01 z-50 !overflow-hidden h-full w-full flex items-center justify-center min-h-[60vh] flex-col gap-4'>
			<Logo />
		</div>
	);
};

export default PreLoadingPage;
