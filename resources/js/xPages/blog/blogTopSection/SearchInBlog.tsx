import React, { useEffect, useState } from "react";
import { blogCategoriesData } from "../../../data/blogData";
import { Button } from "../../../xcomponents";
import CategoryIcon from "../blogCategories/CategoryIcon";
import SearchIcon from "./SearchIcon";

const SearchInBlog = ({ autoSearch = false, className = "flex" }) => {
    const [search, setSearch] = useState("");
    const [filteredCategories, setFilteredCategories] = useState([]);

    useEffect(() => {
        if (autoSearch) handleSearch();
    }, [search, autoSearch]);

    const handleSearch = () => {
        const results = blogCategoriesData.filter((item) =>
            item.category.toLowerCase().includes(search.toLowerCase().trim())
        );

        setFilteredCategories(results);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        handleSearch();
    };

    return (
        <div className={`${className} flex-col items-start self-stretch gap-8`}>
            <form
                onSubmit={handleSubmit}
                className="sm:h-[48px] lg:h-[46px] xl:h-[48px] flex items-center justify-between gap-0 md:justify-start  self-stretch rounded-br-[50px] rounded-tl-[50px] border border-primary-400 bg-bg-01 "
            >
                <div className="flex items-center md:gap-4 gap-2 flex-1 md:pr-10 pr-8">
                    <SearchIcon />
                    <input
                        type="text"
                        value={search}
                        onChange={(e) => setSearch(e.target.value)}
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

            <div className="w-full md:max-h-[80px] max-h-48 flex flex-wrap items-start gap-y-[30px] gap-x-[40px] overflow-y-scroll">
                {filteredCategories.map((item, index) => (
                    <button
                        key={item.id}
                        className={`${
                            index === filteredCategories.length - 1
                                ? ""
                                : "border-l border-Gray-scale-01"
                        } flex py-0 px-[12px] items-center gap-[9px]`}
                    >
                        <CategoryIcon />
                        <p className="regular-b1 text-right text-primary-600">
                            {item.category}
                        </p>
                    </button>
                ))}
            </div>
        </div>
    );
};

export default SearchInBlog;
