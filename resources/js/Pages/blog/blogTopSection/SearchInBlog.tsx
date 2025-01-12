import { useRef } from "react";
import { Button } from "../../../components";
import SearchIcon from "./SearchIcon";

export default function SearchInBlog({ className = "flex" }) {
    const inputRef = useRef<HTMLInputElement>(null);
    const params = new URLSearchParams(window.location.search);

    return (
        <div className={`${className} flex-col items-start self-stretch gap-8`}>
            <form
                method="GET"
                action="/blog"
                className="sm:h-[48px] lg:h-[46px] xl:h-[48px] flex items-center justify-between gap-0 md:justify-start  self-stretch rounded-br-[50px] rounded-tl-[50px] border border-primary-400 bg-bg-01 "
            >
                <div className="flex items-center md:gap-4 gap-2 flex-1 md:pr-10 pr-8">
                    <SearchIcon />
                    <input
                        ref={inputRef}
                        name="search"
                        defaultValue={params.get("search") ?? ""}
                        type="text"
                        placeholder="اكتب ما تريد ان تبحث عنه..."
                        className="w-full h-full bg-transparent outline-none border-none regular-b1 placeholder:text-Gray-scale-03 text-primary-500 text-right"
                    />
                </div>
                <Button
                    variant="primary"
                    type="submit"
                    className="md:w-[150px] h-full  flex flex-col justify-center items-center md:gap-[10px] gap-0"
                >
                    بحث
                </Button>
            </form>
        </div>
    );
}
