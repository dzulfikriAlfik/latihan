import React, { Fragment, useState, useEffect } from "react"
import { Dimensions, FlatList } from "react-native"
import { connect } from "react-redux"
import Tailwind from "../../libs/tailwind/Tailwind.lib"
import ItemListCountry from "../molecules/ItemListCountry.molecule"

const ListCountry = () => {
    const [height, setHeight] = useState(0)
    const data = [
        { name: "Indonesia", id: 1 },
        { name: "Arab", id: 2 },
        { name: "India", id: 3 },
        { name: "Miyanmar", id: 4 },
        { name: "Singapura", id: 5 },
        { name: "Laos", id: 6 },
        { name: "Indonesia", id: 7 },
        { name: "Arab", id: 8 },
        { name: "India", id: 9 },
        { name: "Miyanmar", id: 10 },
        { name: "Singapura", id: 11 },
        { name: "Laos", id: 12 }
    ]

    useEffect(() => {
        setHeight(() => Dimensions.get("screen").height)

        Dimensions.addEventListener("change", () => {
            setHeight(() => Dimensions.get("screen").height)
        })
    }, [])

    return (
        <Fragment>
            <FlatList
                data={ data }
                style={ [Tailwind`w-full`, { height: height - 280 }] }
                keyExtractor={ (item, index) => `${ item.name }-${ index }` }
                renderItem={ ({ item }) => <ItemListCountry item={ item }/> }
                showsVerticalScrollIndicator={ true }
            />
        </Fragment>
    )
}

export default ListCountry